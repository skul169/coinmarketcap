<?php

namespace App\Http\Controllers;

use App\Cms;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Session;
use Input;
use Auth;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
 
        $cms = \App\Cms::orderBy('created_at', 'desc')->paginate(25);
        return view('cms.index',compact('cms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if(!Auth::user()->can('faq-manager')){
             return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        return view('cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $formData = array(
			'slug' => Input::get('slug'),
            'titles' => Input::get('titles'),
            'content' => Input::get('content'),
        );

        $rules = array(
            'content' => 'required'
        );

        $messages = [
            'content.required' => 'Please enter your content!'
        ];

        $validation = Validator::make($formData, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::to('cms/create')->withErrors($validation)->withInput();
        }
        Cms::create($formData);
        return \Redirect::to('cms/create')->with('status', 'Creat CMS Success!');
    }


    public function edit($id)
    {
        if(!Auth::user()->can('faq-manager')){
             return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $model = Cms::find($id);
        return view('cms.edit',compact('model'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    public function update()
    {

         $formData = array(
			'slug' => Input::get('slug'),
            'titles' => Input::get('titles'),
            'content' => Input::get('content'),
        );

        $id = Input::get('id');

        $rules = array(
            'content' => 'required'
        );

        $messages = [
            'content.required' => 'Please enter your content!'
        ];


        $validation = Validator::make($formData, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect()->back()->withErrors($validation)->withInput();
        }
        Cms::find($id)->update($formData);
        return \Redirect()->back()->with('status', 'Update CMS Success!');
    }

    public function destroy($id)
    {
        Cms::find($id)->delete();
        return \Redirect()->back()->with('status', 'Delete CMS Success!');
    }


}

?>