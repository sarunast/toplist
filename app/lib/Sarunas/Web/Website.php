<?php namespace Sarunas\Web;
use Illuminate\Support\Facades\View;

Class Website
{
	protected $website;

	/**
	 * Initializer.
	 *
	 * @access   public
	 * @return \BaseController
	 */
	public function __construct()
	{

		//Default values for the website
		$this->website = new \stdClass();
		$this->website->styles = array('application', 'statistics');
		$this->website->scripts = array('application', 'statistics');

		//share the view
		View::share('website', $this->website);
	}

	/**
	 * Function for adding styles
	 * @param $style
	 */
	public function addStyle($style){
		$this->website->styles[] = $style;
	}

	/**
	 * Function for adding javascripts
	 * @param $js
	 */
	public function addScript($script){
		$this->website->scripts[] = $script;
	}

}