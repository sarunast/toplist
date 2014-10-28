<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class StatisticsDailyCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'statistics:daily';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updates database every 24 hours for statistics.';

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
		 * Daily stats script
		 */


        $start = microtime(true);
        $daily_stats = [];
        $monthly_stats = [];
        $yearly_stats = [];
        $servers = DB::table('servers')->get();
        foreach ($servers as $server) {
            //get average online percentage
            $up_percent = round(DB::table('frequent_stats')->where('server_id', $server->id)->avg('online') * 100);
            $daily_stats[] = array(
                'server_id' => $server->id,
                'votes' => $server->day_votes,
                'clicks' => $server->day_clicks,
                'rank' => $server->rank,
                'up_percent' => $up_percent,
                'created_at' => new Datetime(),
            );
            $days = round(abs(strtotime(date('Y-m-d', strtotime('now')))-strtotime($server->created_at))/86400);
            if (($days % 30) == 0 && $days != 0 ){
                $up_percent = round(DB::table('day_stats')->where('server_id', $server->id)->avg('up_percent') * 100);
                $votes = DB::table('day_stats')->where('server_id', $server->id)->sum('votes');
                $clicks = DB::table('day_stats')->where('server_id', $server->id)->sum('clicks');
                $rank = round(DB::table('day_stats')->where('server_id', $server->id)->avg('rank'));
                $monthly_stats[] = array(
                    'server_id' => $server->id,
                    'votes' => $votes,
                    'clicks' => $clicks,
                    'rank' => $rank,
                    'up_percent' => $up_percent,
                    'created_at' => new Datetime(),
                );
            }
            if (($days % 360) == 0 && $days != 0){
                $up_percent = round(DB::table('month_stats')->where('server_id', $server->id)->avg('up_percent') * 100);
                $votes = DB::table('month_stats')->where('server_id', $server->id)->sum('votes');
                $clicks = DB::table('month_stats')->where('server_id', $server->id)->sum('clicks');
                $rank = round(DB::table('month_stats')->where('server_id', $server->id)->avg('rank'));
                $yearly_stats[] = array(
                    'server_id' => $server->id,
                    'votes' => $votes,
                    'clicks' => $clicks,
                    'rank' => $rank,
                    'up_percent' => $up_percent,
                    'created_at' => new Datetime(),
                );
            }

        }

        //delete older data
        DB::table('frequent_stats')->delete(); // delete old records
        DB::table('votes')->delete();

        $date = date('Y-m-d', strtotime('-30 day'));
        DB::table('day_stats')->where('created_at', '<', $date)->delete();

        $date = date('Y-m-d', strtotime('-360 day'));
        DB::table('month_stats')->where('created_at', '<', $date)->delete();

        //insert data
        if(count($daily_stats))
            DB::table('day_stats')->insert($daily_stats); //insert data
        if(count($monthly_stats))
            DB::table('month_stats')->insert($monthly_stats); //insert data
        if(count($yearly_stats))
            DB::table('year_stats')->insert($yearly_stats); //insert data

        //update data
        DB::table('servers')->update(array('day_votes' => 0));
        DB::table('servers')->update(array('day_clicks' => 0));

		//log
		$time = microtime(true) - $start;
		Log::info('[daily] time tuck to run script '.number_format($time,2));
		$this->info('[daily] time tuck to run script '.number_format($time,2));

	}


}