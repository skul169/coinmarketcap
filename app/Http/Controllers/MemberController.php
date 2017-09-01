<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;
use Auth;
use Input;
use Flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Pagination\Paginator;
use Log;
use App\StockPrice;
class MemberController extends Controller {

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        $user = \App\User::find($id);
        return view('member.show')->with('user', $user);
    }

    public function dashboard(Request $request) {

        $user = Auth::user();

        $key = $request->get('symbol');
        $query = \App\Stockinfo::query();
        if ($key != null) {
            $query = $query->where('symbol', 'like', '%' . $key . '%');
        }
        $stockinfo = $query->orderBy('sortOrder', 'ASC')->paginate(10);
        // $stockinfo = \App\Stockinfo::orderBy('sortOrder', 'ASC')->paginate(25);
        $request->flash();

        
        $total_sock = \App\Stockinfo::query()->count();
        
        return view('member.dashboard')
                        ->with('stockinfo', $stockinfo)
                        ->with('total_sock', $total_sock);
                        // ->with('configBitgos', $configBitgos)
                        // ->with('configDeposits', $configDeposits)
                        //  ->with('configTraders', $configTraders);
    }

   public function acstatus($symbol) {
         $user = Auth::user();
        

        $Stockinfo = \App\Stockinfo::find($symbol);
         if($Stockinfo->status == 0){

            $Stockinfo->update(array('status' => 1));
            \App\StockPrice::find($symbol)->update(array('status' => 1));
         }else{
            $Stockinfo->update(array('status' => 0));
            \App\StockPrice::find($symbol)->update(array('status' => 0));
         }
          
        return \Redirect()->back()->with('status', 'Update Success!');
    }
    
    public function addstock() {
         $user = Auth::user();

        return view('stockinfo.create');
    }
    public function storestock() {
         $user = Auth::user();

        return view('stockinfo.create');
    }

    
    public function signup() {
        return view('member.signup');
    }

    public function profile($action) {
        $profile = Auth::user();
        $link_referer = $profile->referer;
        $url = new UserController();
        $referer_chuoi_goc = $url->full_url() . "/" . $link_referer;
        $sponsor = \App\User::where('id', '=', Auth::user()->sponsor_id)->first();
        $referer = str_replace("member/profile/changeprofile", "user/createmember", $referer_chuoi_goc);
        $gender = $profile->gender;
        switch ($gender) {
            case 0:
                $gender = "0";
                $genderop_value = "";
                $genderop_name = "";
                break;
            case 1:
                $gender_name = "Male";
                $genderop_value = "2";
                $genderop_name = "Female";
                break;
            case 2:
                $gender_name = "Female";
                $genderop_value = "1";
                $genderop_name = "Male";
                break;
        }
        define("changeprofile", "changeprofile");
        define("changeloginpass", "changeloginpass");
        $active = array();
        switch ($action) {
            case changeprofile:
                $active[changeprofile] = "active";
                $active[changeloginpass] = "";

                break;
            case changeloginpass:
                $active[changeprofile] = "";
                $active[changeloginpass] = "active";
                break;
        }


        $listcountry = $this->countries;


        return view('member.profile', compact('sponsor', 'referer', 'profile', 'gender', 'genderop_value', 'gender_name', 'genderop_name', 'active', 'listcountry'));
    }

    public function update(Request $request) {


        $user = Auth::user();
        $formData = array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'phone' => Input::get('phone'),
            'peopleid' => Input::get('peopleid'),
            'blockchain' => Input::get('blockchain'),
            'birthday' => Input::get('birthday'),
            'gender' => Input::get('gender'),
            'address' => Input::get('address'),
            'country' => Input::get('country'),
            'avatar' => Input::file('avatar'),
            'fontside' => Input::file('fontside'),
            'backside' => Input::file('backside'),
        );

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'peopleid' => 'numeric|min:9',
            'phone' => 'numeric|min:10',
            'address' => '',
            'avatar' => 'image|max:1000',
            'fontside' => 'image|max:2000',
            'backside' => 'image|max:2000',
            'transactionpassword' => 'required',
        );

        $messages = [
            'name.required' => 'Please enter your Full Name!',
            'email.required' => 'Please enter your Email!',
            'peopleid.numeric' => 'The Pepole ID must be a numeric!',
            'peopleid.min' => 'The Pepole ID must be at least 9 characters!',
            'phone.numeric' => 'The Phone must be a numeric!',
            'phone.min' => 'The Phone must be at least 10 characters!!',
            'blockchain.required' => 'Please enter your Blockchain!',
            'country.required' => 'Please enter your Country!',
            'avatar.image' => 'Avatar must a image file!',
            'fontside.image' => 'Font Side must a image file!',
            'backside.image' => 'Back Side must a image file!',
            'transactionpassword.required' => 'Please enter Transaction Password!',
        ];

        $validation = Validator::make($formData, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::to('member/profile/changeprofile')->withErrors($validation)->withInput();
        }


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $destinationPath = public_path() . '/uploads/images/avatar/';

            $name_avatar = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();

            $path = $destinationPath . $name_avatar;

            Image::make($file)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $formData['avatar'] = $name_avatar;
        }



        if ($request->hasFile('fontside')) {
            $file_fontside = $request->file('fontside');

            $destinationPath = public_path() . '/uploads/images/personid/';

            $name_fontside = md5(microtime() . $file_fontside->getClientOriginalName()) . "." . $file_fontside->getClientOriginalExtension();

            $path = $destinationPath . $name_fontside;

            Image::make($file_fontside)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $formData['fontside'] = $name_fontside;
        }

        if ($request->hasFile('backside')) {
            $file_backside = $request->file('backside');

            $destinationPath = public_path() . '/uploads/images/personid/';

            $name_backside = md5(microtime() . $file_backside->getClientOriginalName()) . "." . $file_backside->getClientOriginalExtension();

            $path = $destinationPath . $name_backside;

            Image::make($file_backside)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);



            $formData['backside'] = $name_backside;
        }
        $tranpass = Input::get('transactionpassword');





        if (Hash::check($tranpass, $user->transaction_password)) {
            $user->update($formData);

            return \Redirect::to('member/profile/changeprofile')->with('status', 'Update Profile Success!');
        } else {
            return \Redirect::to('member/profile/changeprofile')->withErrors('Enter Transaction Password Fail !');
        }
    }

    /* ---- Change login password */

    public function changeloginpass() {

        $formData = array(
            'oldpassword' => \Input::get('oldpassword'),
            'newpassword' => \Input::get('newpassword'),
            'confirmpassword' => \Input::get('confirmpassword')
        );

        $rules = array(
            'oldpassword' => 'required|min:6',
            'newpassword' => 'required|min:6',
            'confirmpassword' => 'same:newpassword'
        );

        $messages = [
            'oldpassword.required' => 'Please Enter Old Password!',
            'oldpassword.min' => 'The Old Password must be at least 6 characters!',
            'newpassword.required' => 'Please Enter New Password!',
            'newpassword.min' => 'The New Password must be at least 6 characters!',
            'same' => 'The Confirm Password and New Password not match',
        ];

        $validation = \Validator::make($formData, $rules, $messages);

        if ($validation->fails()) {
            return \Redirect::to('member/profile/changeloginpass')->withErrors($validation)->withInput();
        }

        $user = Auth::user();

        if (Hash::check($formData['oldpassword'], $user->password)) {
            $user->password = bcrypt($formData['newpassword']);
            $user->save();
            return \Redirect::to('member/profile/changeloginpass')->with('status', 'Change Login Password Success.');
        } else {
            return \Redirect::to('member/profile/changeloginpass')->withErrors('Enter Old Login Password Fail.');
        }
    }

  
   
}

?>