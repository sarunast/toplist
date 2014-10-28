<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RankCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'rank:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updates rank number for server groups.';

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
		$start = microtime(true);
		$subcategories = DB::table('subcategories')->get();
		foreach ($subcategories as $subcategory) {
			DB::update('UPDATE  servers
        				JOIN     (SELECT    p.id, @curRank := @curRank + 1  AS rank
        				FROM     servers p
        				JOIN    (SELECT @curRank := 0  ) r where subcategory_id = '.$subcategory->id.'
        				ORDER BY  p.votes DESC
       					 ) ranks ON (ranks.id = servers.id)
        				SET      servers.rank = ranks.rank ;');
		}

		//log
		$time = microtime(true) - $start;
		Log::info('[rank] time tuck to run script '.number_format($time,2));
		$this->info('[rank] time tuck to run script '.number_format($time,2));

	}


}