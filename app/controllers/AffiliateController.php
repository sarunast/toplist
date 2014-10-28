<?php

class AffiliateController extends \BaseController {

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
        return View::make('panel.affiliate');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->addCssJs('createServer');
        return View::make('panel.affiliate.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $message = array('dimension' => 'The :attribute  Image size must be at least 210x170 pixels. GIF must be exactly 210x170 pixels.',);
        $rules = array(
            'title' => 'required|min:3|max:15',
            'url' => 'required|min:5|max:100',
            'image' => 'required|image|max:200|dimension:210,170',
        );

        $validator = Validator::make($data, $rules,$message);
        if ($validator->passes()) {
            $affiliate = new Affiliate;

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
            $affiliate->image = $new_file_name;
            $file->move($upload_path, $new_file_name);

            //grab/resize image
            $img = Image::make($upload_path.$new_file_name);
            $img->grab(210, 170)->save($upload_path.$new_file_name);


            $affiliate->title = $data["title"];
            $affiliate->url = $data["url"];
            $affiliate->user_id = Auth::user()->id;

            $affiliate->save();
            return Redirect::to('panel/affiliate/html')->with('affiliate', $affiliate);
        }

        return Redirect::to('panel/top/create')->withErrors($validator)->withInput();
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}