<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\sayurmodel;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session; 
use DataTables;

class sayuria_controller extends Controller
{
    public $login_id,$password;

    public function v_register(){
        return view('register');
    }

    public function v_beranda(){
        $data=sayurmodel::paginate(3);
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
                if(Auth::user()->role=='admin'){
                    return redirect()->route('admin');
                }else{
                    return redirect()->route('beranda');

                }
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

    public function tampil_produk(Request $request){
        if($request->ajax()){
            $data=sayurmodel::all('*');
            return Datatables::of($data)->addIndexColumn()->addColumn('action',function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        $username=Auth::user()->username;
        return view('welcome',compact('username'));
    }

    public function tambah_produk(Request $request){
        $rules=array(
            'nama_sayur'=>'required',
            'harga_sayur'=>'required',
            'stock'=>'required',
            'deskripsi'=>'required',
            'gambar'=>'required'
        );
        $error=Validator::make($request->all(),$rules);

        if($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data=array(
            'nama_sayur'=>$request->nama_sayur,
            'harga_sayur'=>$request->harga_sayur,
            'stock'=>$request->stock,
            'deskripsi'=>$request->deskripsi,
            'gambar'=>$request->gambar
        );

        sayurmodel::create($form_data);
        return response()->json(['success'=>'Produk Berhasil Di Tambah']);
    }

    public function edit_produk($id){
        if(request()->ajax()){
            $data=sayurmodel::findorFail($id);
            return response()->json(['result'=>$data]);
        }
    }

    public function update_produk(Request $request){
        $rules=array(
            'nama_sayur'=>'required',
            'harga_sayur'=>'required',
            'stock'=>'required',
            'deskripsi'=>'required',
            'gambar'=>'required'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data=array(
            'nama_sayur'=>$request->nama_sayur,
            'harga_sayur'=>$request->harga_sayur,
            'stock'=>$request->stock,
            'deskripsi'=>$request->deskripsi,
            'gambar'=>$request->gambar
        );
        sayurmodel::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Produk Berhasil di updated']);
    }

    public function hapus_produk($id){
        $data=sayurmodel::findOrFail($id);
        $data->delete();
    }

    public function tampil_user(Request $request){
        if($request->ajax()){
            $data=User::all('*');
            return Datatables::of($data)->addIndexColumn()->addColumn('action',function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        $username=Auth::user()->username;
        return view('admin_user',compact('username'));
    }

    public function hapus_user($id){
        $data=User::findOrFail($id);
        $data->delete();
    }

    public function logout_admin(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
