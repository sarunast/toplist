<?php

class PageController extends \BaseController {

    public function index()
    {
        return View::make('index')
            ->with('indexServers', Server::where('rank', 1)->with('subcategory')->orderBy('votes', 'desc')->get())
            ->with('categories', Category::with('subcategories')->get());
    }

    public function faq()
    {
        return View::make('faq')
            ->with('categories', Category::with('subcategories')->get());
    }
    public function page($page)
    {
        $website = Website::where('path', $page)->firstOrFail();
        return View::make('website/home')
            ->with('page', $website)
            ->with('navigations', WebsiteNavigation::where('website_id', $website->id)->with('page')->orderBy('position', 'ASC')->get())
            ->with('header', WebsiteHeader::where('website_id', $website->id)->first())
            ->with('sideApps', DB::select('SELECT t1.identifier FROM website_apps t1 JOIN website_nav_apps t2 ON t1.id = t2.website_app_id AND t2.website_id = '.$website->id.' WHERE t1.nav = 1 ORDER BY t2.position ASC'))
            ->with('servers', WebsiteServer::where('website_id', $website->id)->with('server.subcategory')->get())
            ->with('contents', WebsiteContent::where('website_id', $website->id)->where('website_page_id', 0)->orderBy('created_at', 'DESC')->paginate(10));
    }
    public function pagePost($page, $postId)
    {
        $website = Website::where('path', $page)->firstOrFail();
        $post = WebsiteContent::where('website_id', $website->id)->where('comments', 1)->findOrFail($postId);
        return View::make('website/post')
            ->with('page', $website)
            ->with('navigations', WebsiteNavigation::where('website_id', $website->id)->with('page')->orderBy('position', 'ASC')->get())
            ->with('header', WebsiteHeader::where('website_id', $website->id)->first())
            ->with('sideApps', DB::select('SELECT t1.identifier FROM website_apps t1 JOIN website_nav_apps t2 ON t1.id = t2.website_app_id AND t2.website_id = '.$website->id.' WHERE t1.nav = 1 ORDER BY t2.position ASC'))
            ->with('servers', WebsiteServer::where('website_id', $website->id)->with('server.subcategory')->get())
            ->with('pagePost', $post);
    }
    public function pageCategory($page, $pagePath)
    {
        $website = Website::where('path', $page)->firstOrFail();
        $page = WebsitePage::where('website_id', $website->id)->where('path', $pagePath)->firstOrFail();
        if($page->website_app == 'news'){
            return View::make('website/news')
                ->with('page', $website)
                ->with('navigations', WebsiteNavigation::where('website_id', $website->id)->with('page')->orderBy('position', 'ASC')->get())
                ->with('header', WebsiteHeader::where('website_id', $website->id)->first())
                ->with('sideApps', DB::select('SELECT t1.identifier FROM website_apps t1 JOIN website_nav_apps t2 ON t1.id = t2.website_app_id AND t2.website_id = '.$website->id.' WHERE t1.nav = 1 ORDER BY t2.position ASC'))
                ->with('servers', WebsiteServer::where('website_id', $website->id)->with('server.subcategory')->get())
                ->with('contents', WebsiteContent::where('website_id', $website->id)->where('website_page_id', $page->id)->orderBy('created_at', 'DESC')->paginate(10))
                ->with('pageInfo', $page);
        }else{
            return View::make('website/page')
                ->with('page', $website)
                ->with('navigations', WebsiteNavigation::where('website_id', $website->id)->with('page')->orderBy('position', 'ASC')->get())
                ->with('header', WebsiteHeader::where('website_id', $website->id)->first())
                ->with('sideApps', DB::select('SELECT t1.identifier FROM website_apps t1 JOIN website_nav_apps t2 ON t1.id = t2.website_app_id AND t2.website_id = '.$website->id.' WHERE t1.nav = 1 ORDER BY t2.position ASC'))
                ->with('servers', WebsiteServer::where('website_id', $website->id)->with('server.subcategory')->get())
                ->with('pageInfo', $page);
        }

    }


    public function affiliate()
    {
        return View::make('affiliate')
            ->with('categories', Category::with('subcategories')->get());
    }

    public function contact()
    {
        return View::make('contact')
            ->with('categories', Category::with('subcategories')->get());
    }

    public function advertise()
    {
        return View::make('advertise')
            ->with('categories', Category::with('subcategories')->get());
    }


    public function categories($path)
    {
        $subcategory = Subcategory::where('path', $path)->firstOrFail();
        return View::make('top')
            ->with('servers', Server::where('subcategory_id', $subcategory->id)->orderBy('rank', 'ASC')->paginate(50))
            ->with('subcategory', $subcategory)
            ->with('categories', Category::with('subcategories')->get());
    }

    public function details($path,$id,$slug ='')
    {
        $this->addCssJs('statistics');
        $subcategory = Subcategory::where('path', $path)->firstOrFail();
        $server = $subcategory->servers()->findOrFail($id);
        if (!empty($subcategory->alias)){
            if(Cache::has($server->id)){
                $general = Cache::get($server->id);
            }else{
                $gq = new Gameq\Gameq();
                $gq->addServer(array(
                    'id' => 'data',
                    'type'=> $subcategory->alias,
                    'connect_host' => $server->ip.':'.$server->port,
                ));
                $results = $gq->requestAllData();
                $general = $results['data']['general'];
                Cache::add($server->id, $general, 5);
            }
            if ($server->slug ==$slug)
                return View::make('details')
                    ->with('general', $general)
                    ->with('server', $server)
                    ->with('subcategoryIn', $subcategory)
                    ->with('categories', Category::with('subcategories')->get());
            else {
                return Redirect::to($path.'/'.$id.'/'.$server->slug);
            }

        }
        if ($server->slug ==$slug)
            return View::make('details')
                ->with('server', $server)
                ->with('subcategoryIn', $subcategory)
                ->with('categories', Category::with('subcategories')->get());
        else {
            return Redirect::to($path.'/'.$id.'/'.$server->slug);
        }
    }


}