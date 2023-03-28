<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\sayurmodel;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session; 

class sayuria_controller extends Controller
{
    public $login_id,$password;

    public function v_register(){
        return view('register');
    }

    public function v_beranda(){
        $data=sayurmodel::all();
        return view('beranda',compact('data'));
    }

    public function v_login(){
        return view('login');
    }

    function loginpost(Request $request){
        $this->login_id = $request->input('login_id');
        $this->password = $request->input('password');
        $fieldtype=filter_var($this->login_id,FILTER_VALIDATE_EMAIL)?'email':'username';
        if($fieldtype=='email'){
            $request->validate([
                'login_id'=>'required|email|exists:users,email',
                'password'=>'required'
            ],[
                'login_id.required'=>'email or username required',
                'login_id.exists'=>'Email Tidak Terdaftar',
                'password.required'=>'password is required'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:users,username',
                'password'=>'required'
            ],[
                'login_id.required'=>'email or username required',
                'login_id.exists'=>'Username Tidak Terdaftar',
                'password.required'=>'password is required'
            ]);
        }
        $creds=array($fieldtype=>$this->login_id,'password'=>$this->password);
        if(Auth::guard('web')->attempt($creds)){
            $checkuser=User::where($fieldtype,$this->login_id)->first();
            if($checkuser->blocked==1){
                Auth::guard('web')->logout();
                return redirect()->route('login')->with('error','akun anda telah diblokir');
            }else{
                return redirect()->route('beranda');
            }
        }else{
            return redirect()->route('login')->with('error','email / username atau password salah');
        }
    }

    function registerpost(Request $request){
        $request->validate([
            'nama_depan'=>'required',
            'nama_belakang'=>'required',
            'email'=>'required|email|unique:users',
            'username'=>'required',
            'password'=>'required|required_with:konfirmasi_password',
            'konfirmasi_password'=>'required|same:password'
        ]);

        $data['nama_depan']=$request->nama_depan;
        $data['nama_belakang']=$request->nama_belakang;
        $data['email']=$request->email;
        $data['username']=$request->username;
        $data['password']=Hash::make($request->password);
        $user=User::create($data);

        if(!$user){
            return redirect(route('register'))->with('errors','Registrasi Gagal');
        }
        return redirect(route('login'))->with('success','Registrasi berhasil');
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('beranda'));
    }
}
