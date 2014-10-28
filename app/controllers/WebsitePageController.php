<?php

class WebsitePageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('panel.website.pages.index')
            ->with('pages', WebsitePage::where('website_id', Session::get('website'))->get())
            ->with('pagePath', Website::find(Session::get('website')));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('panel.website.pages.create')
            ->with('pageApps', WebsiteApp::where('page',1)->get());

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        if(WebsitePage::where('website_id', Session::get('website'))->where('path',Str::slug($data["name"]))->first()){
            return Redirect::to('panel/website/pages/create')->withErrors('You already have created page with similar name')->withInput();
        }
        $page = new WebsitePage;
        $page->name = $data["name"];
        $page->website_app = $data["identifier"];
        $page->website_id = Session::get('website');
        if(isset($data["comments"])){
            $page->comments = 1;
        }
        $page->path = Str::slug($data["name"]);


        if ($page->save()) {
            if(isset($data["header"])){
                $nav = new WebsiteNavigation;
                $nav->website_id = Session::get('website');
                $nav->page_id = $page->id;
                $nav->type = 0;
                $nav->save();
            }
            if(isset($data["side"])){
                $nav = new WebsiteNavigation;
                $nav->website_id = Session::get('website');
                $nav->page_id = $page->id;
                $nav->type = 1;
                $nav->save();
            }
            if(isset($data["footer"])){
                $nav = new WebsiteNavigation;
                $nav->website_id = Session::get('website');
                $nav->page_id = $page->id;
                $nav->type = 2;
                $nav->save();
            }
            return Redirect::to('panel/website/pages')->with('flash_notice', 'Page successfully created.');
        } else {
            return Redirect::to('panel/website/pages/create')->withErrors($page->errors())->withInput();
        }

	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('panel.website.pages.edit')
            ->with('page', WebsitePage::where('website_id', Session::get('website'))->findOrFail($id));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = Input::all();
        $check = WebsitePage::where('website_id', Session::get('website'))->where('path',Str::slug($data["name"]))->first();
        if($check && $check->id != $id){
            return Redirect::to('panel/website/pages/'.$id.'/edit')->withErrors('You already have created page with similar name');
        }
        $page = WebsitePage::where('website_id', Session::get('website'))->findOrFail($id);

        $page->path = Str::slug($data["name"]);
        $page->name = $data["name"];
        if(isset($data["comments"])){
            $page->comments = 1;
        }

        if ($page->save()) {
            return Redirect::to('panel/website/pages')->with('flash_notice', 'Page successfully Updated.');
        } else {
            return Redirect::to('panel/website/pages/'.$id.'/edit')->withErrors($page->errors())->withInput();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $page = WebsitePage::where('website_id', Session::get('website'))->findOrFail($id);
        $page->delete();
        WebsiteContent::where('website_id', Session::get('website'))->where('website_page_id', $id)->delete();
        WebsiteNavigation::where('website_id', Session::get('website'))->where('page_id', $id)->delete();
        return Redirect::to('panel/website/pages')->with('flash_notice', 'You have deleted your page.');
	}

}