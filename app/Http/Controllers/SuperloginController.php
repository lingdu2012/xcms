<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperloginController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index(Request $request)
    {   
        $data=array();
        if($request->isMethod('post')){
            $user = $request->input('userName');
            $pwd = $request->input('userPWD');
            $pwd=md5($pwd);
            //查询用户
            $user=DB::table("users")->where([
                ['username', '=', $user],
                ['userpwd', '=', $pwd],
            ])->exists();
            //是否进入跳转
            if($user){
                session(['user' => 'admin']);
                return redirect('/super/index');
            }else{
                $data['error']=1;
            }
           
        }
      
        return view('super.login',$data);
    }
    public function out(Request $request){
        
        $request->session()->flush();
        return redirect('/superlogin/index');

    }
}