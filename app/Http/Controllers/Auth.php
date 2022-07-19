<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Auth extends Controller
{
    public function login()
    {
        if (Session::get('login')) {
            return redirect('/beranda');
        }   

        return view('auth.login');
    }

    public function register()
    {
        if (Session::get('login')) {
            return redirect('/beranda');
        }   

        return view('auth.regis');
    }

    public function regPost(Request $request)
    {
        $data = Pengguna::where('alamat_email', $request->email)->first();
        if ($data) {
            return redirect('register')->with('alert', 'Alamat Email sudah terdaftar');
        } elseif ($request->password != $request->passwordConf) {
            return redirect('register')->with('alert', 'Password harus diisi sama');
        } else {
            $imgs = ["reimu.jpg", "minami.jpg", "alex.jpg"];

            $data =  new Pengguna();
            $data->nama = $request->nama;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->alamat_email = $request->email;
            $data->password = bcrypt($request->password);
            $data->tanggal_lahir = $request->birthday;
            $data->deskripsi = "User have no descriptions.";
            $data->gambar = $imgs[rand(0, 2)];
            $data->save();
            return redirect('login')->with('alert-success', 'Kamu berhasil Register');
        }
    }

    public function logPost(Request $request) {
        $data = Pengguna::where('alamat_email', $request->email)->first();
        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                $nama = explode(" ", $data->nama); $nama = $nama[0];
                Session::put('mail', $data->alamat_email);
                Session::put('namae', $nama);
                Session::put('img', $data->gambar);
                Session::put('login', TRUE);
                return redirect('/beranda');
            } else {
                return redirect('login')->with('alert', 'Username atau Password ');
            }
        } else {
            return redirect('login')->with('alert', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login')->with('alert-success', 'Logut Berhasil!');
    }
}
