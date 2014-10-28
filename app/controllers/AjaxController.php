<?php

class AjaxController extends \BaseController {

    public function servers($id){
        $data = Input::all();
        if (is_numeric ($data['number'])){
            if ($data['search'] != 'undefined'){
                $data['search'] = '%'.$data['search'].'%';


                Return  DB::select('select votes, rank, title, description, url, image, slug, online, id from servers where subcategory_id = '.$id.' and ( title LIKE "'
                .$data['search'].'" or description LIKE "'.$data['search'].'") ORDER BY rank ASC LIMIT '.$data['number'].', 50;');
            }else {
                Return  DB::select('select votes, rank, title, description, url, image, slug, online, id from servers where subcategory_id = '.$id.' ORDER BY rank ASC LIMIT '.$data['number'].', 50;');
            }
        }
        Return 'nope';

    }

    public function statistics($id){
        return DB::table('day_stats')->where('server_id', $id)->get();
    }

}
