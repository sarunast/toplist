<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SitemapCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'sitemap:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generates google site map for the site.';

	/**
	 * Create a new command instance.
	 *
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
		 * Generate Sitemap for site
		 */

		$start = microtime(true);
		$data = Category::with('subcategories.servers')->get();
		$url = 'http://tamytop.com';

		$record = function($loc, $priority, $lastmod = false, $changefreq = "daily") {
			//check if the date was set
			$lastmod = $lastmod ? $lastmod : date('Y-m-d');

			//Template
			$record = "\t"."<url>".PHP_EOL;
			$record .= "\t\t"."<loc>".$loc."</loc>".PHP_EOL;
			$record .= "\t\t"."<lastmod>".$lastmod."</lastmod>".PHP_EOL;
			$record .= "\t\t"."<changefreq>$changefreq</changefreq>".PHP_EOL;
			$record .= "\t\t"."<priority>".$priority."</priority>".PHP_EOL;
			$record .= "\t"."</url>".PHP_EOL;

			return $record;
		};

		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

		//custom urls
		$sitemap .= $record($url, "1");
		$sitemap .= $record($url.'/affiliate', "0.5", "2013-08-23", "monthly");
		$sitemap .= $record($url.'/contact', "0.5", "2013-08-23", "monthly");
        $sitemap .= $record($url.'/faq', "0.5", "2013-08-23", "monthly");

        foreach ($data as $category) {
			foreach ($category->subcategories as $subcategory){

				//generate categories
				$sitemap .= $record($url.'/'.$subcategory->path, "0.8");

                $count = 0;
				foreach($subcategory->servers as $server){
					$count++; //count how many there are records

					//generate links to detail pages
					$sitemap .= $record($url.'/'.$subcategory->path.'/'.$server->id.'/'.$server->slug, "0.6");
				}

				//generate pages for categories
				$pages = 1+intval($count / 50);
				for($i = 2; $i <= $pages; $i++){
					if($i != 1){
						$sitemap .= $record($url.'/'.$subcategory->path.'?page='.$i, "0.5");
					}
				}
			}
		}
		$sitemap .= '</urlset>'.PHP_EOL;

		//update file
		File::put(public_path().'/sitemap.xml', $sitemap);

        //Google
        $siteMapUrl = $url."/sitemap.xml";
        $pingUrl="http://www.google.com/webmasters/sitemaps/ping?sitemap=" . urlencode($siteMapUrl);
        $response = file_get_contents($pingUrl);
        Log::info('Google Sitemaps has been pinged (return code: '.$response.')');

        //log
		$time = microtime(true) - $start;
		Log::info('[sitemap] time tuck to run script '.number_format($time,2));
		$this->info('[sitemap] time tuck to run script '.number_format($time,2));

	}


}