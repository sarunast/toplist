<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class StatisticsFrequentCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'statistics:frequent';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Checks servers online status very frequently for statistics.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		/**
		 * Generate constant updates about server status
		 */
		$start = microtime(true);
		$servers_info= [];
		$servers = Server::with('subcategory')->get();
		$online = [];
		$offline = [];
		$counter = 0;
		$gq = new Gameq\Gameq();

		foreach($servers as $server){

			$counter++;

			if($server->subcategory->alias){

				$gq->addServer(array(
					'id' => $server->id,
					'type'=> $server->subcategory->alias,
					'connect_host' => $server->ip.':'.$server->port,
				));

			}else{
				//if we don't know the protocol
				$fp = @fsockopen($server->ip, $server->port, $a, $d, 1); //timeout 1 second
				if (!$fp) {
					$servers_info[] = array('server_id' => $server->id, 'online' => 0, 'created_at' => new DateTime());
					$offline[] = $server->id;
				}
				else {
					$servers_info[] = array('server_id' => $server->id, 'online' => 1, 'created_at' => new DateTime());
					$online[] = $server->id;
				}
			};


		}

		//Gameq
		$results = $gq->requestAllData();

		foreach ($results as $key => $result) {

			if($result['general']){
				$servers_info[] = array('server_id' => $key, 'online' => 1, 'created_at' => new DateTime());
				$online[] = $key;
			}
			else {
				$servers_info[] = array('server_id' => $key, 'online' => 0, 'created_at' => new DateTime());
				$offline[] = $key;
			}
		}

		DB::table('frequent_stats')->insert($servers_info);
		//checking if arrays are not empty
		if ($online){
			DB::table('servers')->whereIn('id', $online)->update(array('online' => 1));
		}
		if ($offline){
			DB::table('servers')->whereIn('id', $offline)->update(array('online' => 0));
		}
		//log
		$time = microtime(true) - $start;
		Log::info('[frequent] '.$counter.' servers updated. Time tuck to run script '.number_format($time,2));
		$this->info('[frequent] '.$counter.' servers updated. Time tuck to run script '.number_format($time,2));

	}


}