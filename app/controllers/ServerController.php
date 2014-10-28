<?php

class ServerController extends \BaseController {

	/**
	 * Instantiate a new UserController instance.
	 */
	public function __construct()
	{
		parent::__construct();
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
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('panel.top.index')
            ->with('servers', Server::where('user_id', Auth::user()->id)->with('subcategory')->get());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function create(){

        $this->addCssJs('createServer');
        return View::make('panel.top.create')
            ->with('categories', Category::with('subcategories')->get());
    }
	public function store()
	{
        $data = Input::all();
        $message = array('dimension' => 'The :attribute  Image size must be at least 210x170 pixels. GIF must be exactly 210x170 pixels.',);
        $rules = array(
            'title' => 'required|min:3|max:15',
            'url' => 'required|min:5|max:100',
            'description' => 'required|max:110',
            'ip' => 'required|ip',
            'port' => 'required|numeric|max:65535',
            'subcategory_id' => 'required',
            'image' => 'image|max:200|dimension:210,170',
        );

        $validator = Validator::make($data, $rules,$message);
        if ($validator->passes()) {
            $server = new Server;
            if(Input::file('image')){
                $file = Input::file('image');
                $upload_path = 'uploads/';
                $file_name = Str::slug($data["title"]).'.'.$file->getClientOriginalExtension();
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
                $server->image = $new_file_name;
                $file->move($upload_path, $new_file_name);

				//grab/resize image
				$img = Image::make($upload_path.$new_file_name);
				$img->grab(210, 170)->save($upload_path.$new_file_name);
            }


            $server->title = $data["title"];
            $server->url = $data["url"];
            $server->description = $data["description"];
            $server->ip = $data["ip"];
            $server->slug = Str::slug($data["title"]);
            $server->port = $data["port"];
            $server->online = 1;
            $server->rank = Server::where('subcategory_id', $data["subcategory_id"])->count() + 1;
            $server->subcategory_id = $data["subcategory_id"];
            $server->user_id = Auth::user()->id;

            $server->save();
            return Redirect::to('panel/top/html')->with('server', $server);
        }

        return Redirect::to('panel/top/create')->withErrors($validator)->withInput();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('panel.top.edit')
            ->with('categories', Category::with('subcategories')->get())
            ->with('server', Server::where('user_id', Auth::user()->id)->findOrFail($id));
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

        $message = array('dimension' => 'The :attribute  Image size must be at least 210x170 pixels. GIF must be exactly 210x170 pixels.',);


        $rules = array(
            'title' => 'required|min:3|max:15',
            'url' => 'required|min:5|max:100',
            'description' => 'required|max:110',
            'ip' => 'required|ip',
            'port' => 'required|numeric|max:65535',
            'image' => 'image|max:200|dimension:210,170',
        );

        $validator = Validator::make($data, $rules,$message);

        if ($validator->passes()) {

            $server = Server::where('user_id', Auth::user()->id)->findOrFail($id);
            if(Input::file('image')){

                $file = Input::file('image');
                $upload_path = 'uploads/';

				//check if server has already image if so delete it
				if($server->image){
					File::delete($upload_path.$server->image);
				}

                $file_name = Str::slug($data["title"]).'.'.$file->getClientOriginalExtension();
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
                $server->image = $new_file_name;
                $file->move($upload_path, $new_file_name);

				//grab/resize image
				$img = Image::make($upload_path.$new_file_name);
				$img->grab(210, 170)->save($upload_path.$new_file_name);
			}


            $server->title = $data["title"];
            $server->slug = Str::slug($data["title"]);
            $server->url = $data["url"];
            $server->description = $data["description"];
            $server->ip = $data["ip"];
            $server->port = $data["port"];

            $server->save();
            return Redirect::to('panel/top')->with('flash_notice', 'Your top has been edited and saved');
        }

        return Redirect::to('panel/top/'.$id.'/edit')->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $server = Server::where('user_id', Auth::user()->id)->findOrFail($id);
        if($server->image){
            File::delete($upload_path.$server->image);
        }
        DB::table('day_stats')->where('server_id', $server->id)->delete();
        DB::table('month_stats')->where('server_id', $server->id)->delete();
        DB::table('year_stats')->where('server_id', $server->id)->delete();
        $server->delete();
        return Redirect::to('panel/top')->with('flash_notice', 'You have deleted your top.');
	}

}