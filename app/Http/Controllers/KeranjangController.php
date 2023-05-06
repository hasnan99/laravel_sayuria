<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sayurmodel;
use App\Models\User;
use App\Models\keranjang;
use App\Models\order;
use Illuminate\Support\Facades\Auth;  
use Session;
use DB;

class KeranjangController extends Controller
{
    public function viewKeranjang(){
        $keranjang=keranjang::where('user_id',Auth::id())->get();
        return view('keranjang' ,compact('keranjang'));
    }

    public function addToKeranjang(Request $request){
        $sayur_id = $request->sayur_id;
        $quantity = $request->jumlah;
    
        if (Auth::check()) {
            $sayur_check = sayurmodel::where('id', $sayur_id)->first();
            if ($sayur_check) {
                $stok = $sayur_check->stock;
                if ($stok >= $quantity) {
                    if (keranjang::where('sayur_id', $sayur_id)->where('user_id', Auth::id())->exists()) {
                        return redirect()->back()->with('errors', $sayur_check->nama_sayur . " sudah ditambahkan ke keranjang");
                    } else {
                        $keranjang = new keranjang();
                        $keranjang->sayur_id = $sayur_id;
                        $keranjang->user_id = Auth::id();
                        $keranjang->quantity = $quantity;
                        $keranjang->save();
                        return redirect()->back()->with('success', 'Sayur berhasil ditambahkan ke keranjang!');
                    }
                } else {
                    return redirect()->back()->with('errors','Stock Tidak Mencukupi');
                }
            }
        } else {
            return redirect()->back()->with('errors','Sayur sudah ditambahkan ke keranjang');
        }
    }

    public function updateKeranjang(Request $request)
    {
       $sayur_id=$request->input('sayur_id');
       $quantity=$request->input('quantity');

       foreach ($sayur_id as $key => $sayur_id) {
        $keranjang = keranjang::where('sayur_id', $sayur_id)->first();
        $keranjang->quantity = $quantity[$key];
        $keranjang->save();
    }

    return redirect()->back();

    }

    public function removeFromKeranjang($id){
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect()->back();
    }

    public function v_order(){
        $user_id = Auth::id();
        $user = Auth::user()->username;
        $keranjang = keranjang::where('user_id', $user_id)->get();
        $total = 0;
    
        foreach ($keranjang as $item) {
            $total += $item->item_sayur->harga_sayur * $item->quantity;
        }
    
        return view('order', compact('total', 'user'));
    }

    static function list_item(){
        $keranjang=keranjang::where('user_id',Auth::id())->get();
        return $keranjang->count();
    }

    public function orderplace(Request $request){
        $user_id = Auth::id();
        $keranjang=keranjang::where('user_id',$user_id)->get();
        foreach($keranjang as $cart){
            $order=new order;
            $order->sayur_id=$cart['sayur_id'];
            $order->user_id=$cart['user_id'];
            $order->nama_penerima=$request->name;
            $order->quantity=$cart['quantity'];
            $order->status="pending";
            $order->metode_pembayaran=$request->payment;
            $order->status_pembayaran="pending";
            $order->alamat=$request->alamat . " " . $request->city . " " . $request->state . " " . $request->zip;;
            $order->bukti="belum ada";
            $order->save();
            
            keranjang::where('user_id',$user_id)->delete();

            $sayur = sayurmodel::find($cart['sayur_id']);
            $sayur->stock -= $cart['quantity'];
            $sayur->save();
        }
        $request->input();
        if($order->metode_pembayaran == "COD"){
            return redirect('beranda');
        }else{
            return redirect('transfer');
        }
    }

    public function bayar(Request $request){
        $user_id = Auth::id();
        $file_name = $request->bukti->getClientOriginalName();
        $image_path = $request->file('bukti')->storeAs('bukti', $file_name, 'public');
        $form_data = array(
            'bukti' => 'storage/' . $image_path
        );
        order::where('user_id', $user_id)->where('metode_pembayaran', 'TFB')->update($form_data);
        return redirect('beranda');
    }

    public function transfer(){
        return view('transfer');
    }

    public function pesanan_saya(){
        $order=order::where('user_id',Auth::id())->get();
        return view('pesanan-saya',['order'=> $order]);
    }
}
