<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Session;
use Input;
use Auth;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if(!Auth::user()->can('faq-manager')){
             return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $faq = \App\Faq::orderBy('created_at', 'desc')->paginate(25);
        return view('faq.index',compact('faq'));
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
        return view('faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $formData = array(
            'question' => Input::get('question'),
            'answer' => Input::get('answer'),
        );

        $rules = array(
            'question' => 'required|min:20',
            'answer' => 'required',
        );

        $messages = [
            'question.required' => 'Please enter Question!',
            'question.min' => 'The Question must be at least 20 characters!',
            'answer.required' => 'Please enter your Answer!',
        ];

        $validation = Validator::make($formData, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::to('faq/create')->withErrors($validation)->withInput();
        }
        Faq::create($formData);
        return \Redirect::to('faq/create')->with('status', 'Creat FAQ Success!');
    }


    public function edit($id)
    {
        if(!Auth::user()->can('faq-manager')){
             return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $model = Faq::find($id);
        return view('faq.edit',compact('model'));
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
            'question' => Input::get('question'),
            'answer' => Input::get('answer'),
        );

        $id = Input::get('id');

        $rules = array(
            'question' => 'required|min:20',
            'answer' => 'required',
        );

        $messages = [
            'question.required' => 'Please enter Question!',
            'question.min' => 'The Question must be at least 20 characters!',
            'answer.required' => 'Please enter your Answer!',
        ];

        $validation = Validator::make($formData, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect()->back()->withErrors($validation)->withInput();
        }
        Faq::find($id)->update($formData);
        return \Redirect()->back()->with('status', 'Update FAQ Success!');
    }



    public function show($id) {
        if(!Auth::user()->can('faq-manager')){
             return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $notification = \App\Notification::find($id);

        return view('notification.show')->with('notification', $notification);
    }

    public function destroy($id)
    {
        Faq::find($id)->delete();
        return \Redirect()->back()->with('status', 'Delete FAQ Success!');
    }


}

?>