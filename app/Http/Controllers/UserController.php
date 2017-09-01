<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Log;
use Auth;
use Input;
use Flash;
use \Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Role;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller {

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit2($id) {
        if (!Auth::user()->can('user-manager')) {
            return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $user = \App\User::find($id);
        $users = \App\User::all()->lists('username', 'id');
        $roles = \App\Role::query()->lists('name', 'id');



        return view('user.edit2')->with('users', $users)->with('user', $user)->with('roles', $roles);
    }
	
    public function member(Request $request) {
        if (!Auth::user()->can('user-manager')) {
            return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
		//$configSponsor = \App\Config::where('key', '=', 'DEFAULTSPONSORID')->first();
        $key = $request->get('username');
        $query = \App\User::query();
        if ($key != null) {
            $query = $query->where('username', 'like', '%' . $key . '%');
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $request->flash();
        //dd($users); 
        $total_user = \App\User::query()->count();
		//$idNonReference = Controller::getConfigByKey('DEFAULTSPONSORID');
       // $defaultReference = \App\User::find($idNonReference);
        return view('user.member')
                ->with('users', $users)
                //->with('defaultReference', $defaultReference)
                ->with('total_user', $total_user);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user = Auth::user();
        $termsofuse = $this->getConfigByKey('TERMSOFUSE');


        $listcountry = $this->countries;

        $ret = view('user.create')->with('termsofuse', $termsofuse)->with('listcountry', $listcountry);
                return $ret;
    }

	
	
    public function index(Request $request) {
        /*if (!Auth::user()->hasRole(['admin'])) {
            return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }*/
        if (!Auth::user()->can('config-manager')) {
            return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $key = $request->get('username');
        $query = \App\User::query();
        if ($key != null) {
            $query = $query->where('username', 'like', '%' . $key . '%');
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $request->flash();
        //dd($users); 
        $total_user = \App\User::query()->count();
        return view('user.index')
                ->with('users', $users)
                ->with('total_user', $total_user);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $rules = array(
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'repassword' => 'same:password',
            'email' => 'required|email',
            'isCondition' => 'required',
        );
        $validation = Validator::make($input, $rules);
        $user = Auth::user();
        $link_referer = $user->referer;
        $user = \App\User::where('referer', '=', $link_referer)->firstOrFail();
        $input['sponsor_id'] = $user->id;
        //$input['parent_id'] = $user->id;
        $input['referer'] = uniqid();
        $input['password'] = bcrypt($input['password']);
        $input['country'] = $input['country'];
        $input['receive_address'] = $this->createBitgoAddress();


        if ($validation->fails()) {
            return \Redirect::to('user/create')->withErrors($validation)->withInput();
        }


        $user = \App\User::create($input);
        $url_root = url();
        // role attach alias
        $roleUser = \App\Role::where('name', '=', 'user')->first();
        $user->attachRole($roleUser); // parameter can be an Role object, array, or id
        return \Redirect()->back()->with('status', 'Register Success!')->with('url', $url_root);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        if (!Auth::user()->can('user-manager')) {
            return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $user = \App\User::find($id);

        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        if (!Auth::user()->can('config-manager')) {
            return \Redirect::to('member/dashboard')->withErrors('You don\'t have permission');
        }
        $user = \App\User::find($id);
        $users = \App\User::all()->lists('username', 'id');
        $roles = \App\Role::query()->lists('name', 'id');
        return view('user.edit')->with('users', $users)->with('user', $user)->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request) {
        $user = \App\User::find($id);
        // print_r($request->all()) ; die();
        $validation = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required',
        ]);
        if ($validation->fails()) {
            return \Redirect()->back()->withErrors($validation)->withInput();
        }

        $input = $request->all();

        

        if ($input['password']) {
            $input['password'] = bcrypt($input['password']);
        }else{
            $input['password'] = $user->password;
        }
        $user->fill($input)->save();
		
        if ($request->get('role_user')) {
			$user->detachRoles($user->roles);
			$user->roles()->attach($input['role_user']);
        }
        Session::flash('flash_message', 'User updated successfully!');
        // return redirect()->back();
        return redirect('user/member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id, Request $request) {
		$configSponsor = \App\Config::where('key', '=', 'DEFAULTSPONSORID')->first();
		if($id == $configSponsor->value){
			redirect()->back()->withErrors("Bạn không được xóa user này")->withInput();;
		}
        $user = \App\User::find($id);
        $ads = \App\UserAds::where('user_id','=',$user->id);
        $deposits = \App\Deposits::where('user_id','=',$user->id);
        $orders = \App\Order::where('user_id','=',$user->id);
        $tranactions = \App\Tranaction::where('user_id','=',$user->id);
        $tranactions->delete();
        $orders->delete();
        $ads->delete();
        $deposits->delete();
        $user->delete();

        Session::flash('flash_message', 'Delete user successfully!');
        return redirect('user/member');
    }

    public function createmember($mahoa) {

        $termsofuse = $this->getConfigByKey('TERMSOFUSE');
        $listcountry = $this->countries;

        $user = \App\User::where('referer', '=', $mahoa)->first();
        if (!$user) {
            echo "Link referer does not exits, Please call Administrator!!!";
        } else {
            $username = $user->username;
            return view('user.createmember')->with('referer', $mahoa)
                            ->with('username', $username)->with('termsofuse', $termsofuse)->with('listcountry', $listcountry);
        }
    }

    public function storemember(Request $request) {
        $input = $request->all();
        $rules = array(
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'repassword' => 'same:password',
            'email' => 'required|email',
            'isCondition' => 'required',
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return \Redirect()->back()->withErrors($validation)->withInput();
        }

        $userreferer = Input::get('userreferer');
        $user = \App\User::where('username', '=', $userreferer)->first();
        if (!$user) {
            return \Redirect()->back()->with('status', 'Wrong Referer!Please call Administration ');
        }
        $input['sponsor_id'] = $user->id;
        $input['username'] = Input::get('username');
        $input['password'] = Input::get('password');
        $input['phone'] = Input::get('phone');
        $input['email'] = Input::get('email');
        $input['blockchain'] = Input::get('blockchain');
        $input['name'] = Input::get('name');
        $input['country'] = Input::get('country');
        $input['referer'] = uniqid();
        $input['password'] = bcrypt($input['password']);
        $input['receive_address'] = $this->createBitgoAddress();

        $user = \App\User::create($input);
        // role attach alias
        return \Redirect()->back()->with('status', 'Register Success!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function report() {
        $total_user = \App\User::query()->count();//cộng root
        $total_member = \App\User::query()->whereNotNull('sponsor_id')->where('status', '=', 2)->count()+1;
        $total_transaction_giaodich = \App\Tranaction::query()->count();
        $total_transaction_choxacnhan = \App\Tranaction::query()->where('status', '=', 0)->count();
        $total_transaction_approve = \App\Tranaction::query()->where('status', '=', 1)->count();
        $total_transaction_reject = \App\Tranaction::query()->where('status', '=', 2)->count();
//        $total_transaction_dispute = \App\Tranaction::query()->where('status', '=', 3)->count();
        return view('user.report')
                ->with('total_member', $total_member)
                ->with('total_transaction_giaodich', $total_transaction_giaodich)
                ->with('total_transaction_choxacnhan', $total_transaction_choxacnhan)
                ->with('total_transaction_approve', $total_transaction_approve)
                ->with('total_transaction_reject', $total_transaction_reject)
                ->with('total_user', $total_user);

    }
}

?>