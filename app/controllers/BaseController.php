<?php

class BaseController extends Controller {

	protected $website;

	/**
	 * Initializer.
	 *
	 * @access   public
	 * @return \BaseController
	 */
	public function __construct()
	{
		//load template assets
		//$assets = new Sarunas\Web\Website();
		$this->beforeFilter('csrf', array('on' => 'post'));

        //Default values for the website
        $this->website = new \stdClass();
        $this->website->styles = array('application');
        $this->website->scripts = array('application');

        //share the view
        View::share('website', $this->website);

	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
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
     *
     * @param $script
     */
    public function addScript($script){
		$this->website->scripts[] = $script;
	}

    /**
     * Function for adding javascripts
     *
     * @param $script
     */
    public function addCssJs($script){
        $this->website->scripts[] = $script;
        $this->website->styles[] = $script;
    }
}