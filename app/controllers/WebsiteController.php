<?php

class WebsiteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('panel.website.index')
            ->with('userPage', Website::where('user_id', Auth::user()->id)->with('navApps')->first())
            ->with('social', WebsiteSocial::where('website_id', Session::get('website'))->first())
            ->with('servers', WebsiteServer::where('website_id', Session::get('website'))->with('server')->get())
            ->with('allServers', Server::where('user_id', Auth::user()->id)->get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if (Website::where('user_id', Auth::user()->id)->count()){
            App::abort(404);
        }
        return View::make('panel.website.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if (Website::where('user_id', Auth::user()->id)->count()){
            App::abort(404);
        }
        $data = Input::all();
        if(Website::where('path', Str::slug($data["path"]))->count()){
            return Redirect::to('panel/website')->withErrors('The path is already taken')->withInput();
        }

        $page = new Website;
        $page->title = $data["title"];
        $page->user_id = Auth::user()->id;
        $page->path = Str::slug($data["path"]);

        if ($page->save()) {
            Session::put('website', $page->id);
            $head = new WebsiteHeader;
            $head->website_id = $page->id;
            $head->save();
            $social = new WebsiteSocial;
            $social->website_id = $page->id;
            $social->save();

            return Redirect::to('panel/website');
        } else {
            return Redirect::to('panel/website/create')->withErrors($page->errors())->withInput();
        }
	}
    public function updateBasic()
    {
        $data = Input::all();
        $page = Website::where('user_id', Auth::user()->id)->first();
        $page->title = $data["title"];
        $page->user_id = Auth::user()->id;
        if($page->path != Str::slug($data["path"])){
            if(Website::where('path', Str::slug($data["path"]))->count()){
                return Redirect::to('panel/website')->withErrors('The path is already taken')->withInput();
            }else {
                $page->path = Str::slug($data["path"]);
            }
        }
        $page->paypal_email = $data["paypal_email"];
        $page->email = $data["email"];

        if ($page->save()) {
            $social = WebsiteSocial::where('website_id', Session::get('website'))->first();
            if(!$social){
                $social = new WebsiteSocial;
                $social->website_id = Session::get('website');
            }
            $social->facebook= $data["facebook"];
            $social->gplus = $data["gplus"];
            $social->twitter = $data["twitter"];
            if ($social->save()) {
                return Redirect::to('panel/website')->with('flash_notice', 'Your information has been changed.');
            } else {
                return Redirect::to('panel/website')->withErrors($page->errors())->withInput();
            }
        } else {
            return Redirect::to('panel/website')->withErrors($page->errors())->withInput();
        }
    }
    public function navigations()
    {

        return View::make('panel.website.navigations')

            ->with('head', DB::select('SELECT t1.id, t1.name, t2.website_id FROM website_pages t1 LEFT JOIN website_navigations t2 ON t1.id = t2.page_id AND t2.type = 0  WHERE t1.website_id = '.Session::get('website').'
            ORDER BY ISNULL(t2.position), t2.position ASC'))
            ->with('side', DB::select('SELECT t1.id, t1.name, t2.website_id FROM website_pages t1 LEFT JOIN website_navigations t2 ON t1.id = t2.page_id AND t2.type = 1  WHERE t1.website_id = '.Session::get('website').'
            ORDER BY ISNULL(t2.position), t2.position ASC'))
            ->with('footer', DB::select('SELECT t1.id, t1.name, t2.website_id FROM website_pages t1 LEFT JOIN website_navigations t2 ON t1.id = t2.page_id AND t2.type = 2  WHERE t1.website_id = '.Session::get('website').'
            ORDER BY ISNULL(t2.position), t2.position ASC'));

    }
    public function addNavigation()
    {
        $data = Input::all();
        if(!isset($data['sort'])){
            WebsiteNavigation::where('website_id', Session::get('website'))->delete();
            return Redirect::to('panel/website/navigation')->with('flash_notice', 'You information Saved.');
        }
        for ($i = 0; $i <= 2; $i++){
            if(isset($data['sort'][$i])){
                WebsiteNavigation::whereNotIn('page_id', $data['sort'][$i])->where('website_id', Session::get('website'))->where('type', $i)->delete();
                $count = 1;
                foreach ($data['sort'][$i] as $id){
                    $navigation = WebsiteNavigation::where('website_id', Session::get('website'))->where('page_id', $id)->where('type', $i)->first();
                    if($navigation){
                        $navigation->position = $count;
                    } else{
                        $navigation = new WebsiteNavigation;
                        $navigation->website_id = Session::get('website');
                        $navigation->page_id = $id;
                        $navigation->position = $count;
                        $navigation->type = $i;
                    }
                    $navigation->save();
                    $count++;
                }
            }
        }
        return Redirect::to('panel/website/navigation')->with('flash_notice', 'You information Saved.');


    }
    public function header()
    {
        return View::make('panel.website.header')
            ->with('pageApps', WebsiteApp::where('header',1)->get())
            ->with('webHeader', WebsiteHeader::where('website_id', Session::get('website'))->first());

    }
    public function postHeader()
    {
        Validator::extend('dimension', function($attribute, $value, $parameters)
        {

            $image = getimagesize($value);

            //check if gif image if so image size should be exactly as specified
            if($value->getClientOriginalExtension() == "gif"){
                if( ((isset($parameters[0])) && $image[0] == $parameters[0])
                    && ((isset($parameters[1])) && $image[1] == $parameters[1] )){
                    return true;
                }
                return false;
            };

            //any other static images can be larger
            if( ((isset($parameters[0])) && $image[0] >= $parameters[0])
                && ((isset($parameters[1])) && $image[1] >= $parameters[1] )){
                return true;
            }
            return false;
        });

        $data = Input::all();
        $message = array('dimension' => 'The :attribute  Image size must be at least 1173x110 pixels. GIF must be exactly 1173x110 pixels.',);

        $rules = array(
            'title' => 'min:3|max:25',
            'size'  =>  'required|numeric|min:110|max:500',
            'slogan' => 'min:3|max:35',
            'color'         =>  'alpha_num|max:6|min:6',
            'image' => 'image|max:700|dimension:1173,'.$data["size"],
        );
        $validator = Validator::make($data, $rules,$message);

        if ($validator->passes()) {

            $header = WebsiteHeader::where('website_id', Session::get('website'))->firstOrFail();
            if(Input::file('image')){

                $file = Input::file('image');
                $upload_path = 'uploads/';

                //check if server has already image if so delete it
                if($header->image){
                    File::delete($upload_path.$header->image);
                }

                $file_name = Str::slug(Website::findOrFail(Session::get('website'))->path).'.'.$file->getClientOriginalExtension();
                //for now leaving the name as the original file
                $new_file_name = $file_name;
                //checking if there is file with the same file name
                if(File::exists($upload_path.$file_name))
                {
                    //creating a new file name
                    $i = 1;
                    while (File::exists($upload_path.$i.$file_name)) {
                        $i++;
                    }
                    $new_file_name = $i.$file_name;
                };
                $header->image = $new_file_name;
                $file->move($upload_path, $new_file_name);

                //grab/resize image
                $img = Image::make($upload_path.$new_file_name);
                $img->grab(1173, $data["size"])->save($upload_path.$new_file_name);
            }


            $header->title = $data["title"];
            $header->size = $data["size"];
            $header->slogan = $data["slogan"];
            $header->color = $data["color"];
            if(isset($data["panel"])){
                $header->panel = $data["panel"];
            }
            $header->save();
            return Redirect::to('panel/website/header')->with('flash_notice', 'Your top has been edited and saved');
        }

        return Redirect::to('panel/website/header')->withErrors($validator);
    }

    public function addServer()
    {

        $data = Input::all();
        $id = Server::where('user_id', Auth::user()->id)->find($data["server"]);
        if(!$id){
            return Redirect::to('panel/website');
        }
        $page = new WebsiteServer;
        $page->website_id = Session::get('website');
        $page->server_id = $id->id;

        if ($page->save()) {
            return Redirect::to('panel/website')->with('flash_notice', 'Your have added Server.');
        } else {
            return Redirect::to('panel/website');
        }
    }
    public function removeServer($id)
    {
        $server = WebsiteServer::where('website_id', Session::get('website'))->findOrFail($id);
        $server->delete();
        return Redirect::to('panel/website')->with('flash_notice', 'You have deleted Server.');

    }

    public function addSideNav()
    {
        $data = Input::all();
        if(!isset($data['sort'])){
            WebsiteNavApp::where('website_id', Session::get('website'))->delete();
            return Redirect::to('panel/website/widgets')->with('flash_notice', 'Changes Saved.');
        }
        WebsiteNavApp::whereNotIn('website_app_id', $data['sort'])->where('website_id', Session::get('website'))->delete();
        $count = 1;
        foreach ($data['sort'] as $id){
            $app = WebsiteNavApp::where('website_id', Session::get('website'))->where('website_app_id', $id)->first();
            if($app){
                $app->position = $count;
            } else{
                $app = new WebsiteNavApp;
                $app->website_id = Session::get('website');
                $app->website_app_id = $id;
                $app->position = $count;
            }
            $app->save();
            $count++;
        }

        return Redirect::to('panel/website/widgets')->with('flash_notice', 'Changes Saved.');


    }

    public function addContent()
    {
        $data = Input::all();
        $id = WebsitePage::where('website_id', Session::get('website'))->find($data["page"]);
        if($id || $data["page"] == 0){
            $content = new WebsiteContent;
            $content->website_id = Session::get('website');
            $content->website_page_id = $data["page"];
            $content->content = Purifier::clean($data["content"]);

            if($data["page"] == 0 || $id->comments){
                $content->comments = 1;
            }
            $content->title = $data["title"];
            if ($content->save()) {
                return Redirect::back()->with('flash_notice', 'Your Post Have been submitted.');
            } else {
                return Redirect::back()->withErrors('Could not submit post');
            }
        }

    }
    public function editContent()
    {
        $data = Input::all();
        $content = WebsiteContent::where('website_id', Session::get('website'))->findOrFail($data["content_id"]);
        $content->content = Purifier::clean($data["content"]);
        $content->title = $data["title"];
        if ($content->save()) {
            return Redirect::back()->with('flash_notice', 'Your Post Have been saved.');
        } else {
            return Redirect::back()->withErrors('Could not submit post');
        }


    }
    public function removeContent($id)
    {
        $server = WebsiteContent::where('website_id', Session::get('website'))->findOrFail($id);
        $server->delete();
        return Redirect::to('/')->with('flash_notice', 'You have deleted Post.');

    }
    public function sendEmail()
    {
        $data = Input::all();
        $rules = array(
            'subject' => 'required|min:5|max:30',
            'email' => 'required|email|max:50',
            'content' => 'required|min:20|max:1000',
            'recaptcha_response_field' => 'required|recaptcha',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            Mail::send('emails.website', $data, function($message) use ($data)
            {
                $message->to(Website::findOrFail($data['id'])->email);
            });
            return Redirect::back()->with('flash_notice', 'Your message have been sent.');
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }
    public function widgets()
    {
        return View::make('panel.website.widgets')
            ->with('navApps', DB::select('SELECT t1.id, t1.name, t1.identifier, t2.position FROM website_apps t1 LEFT JOIN website_nav_apps t2 ON t1.id = t2.website_app_id AND t2.website_id = '.Session::get('website').' WHERE t1.nav = 1
            ORDER BY ISNULL(t2.position), t2.position ASC'));
    }

}