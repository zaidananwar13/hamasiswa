<?php

namespace App\Http\Controllers;

use App\Models\Pengguna as ModelsPengguna;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Pengguna extends Controller
{
    public function profile($id = null)
    {
        if ($id != null) {
        }

        $user = ($id == null) ? ModelsPengguna::where('alamat_email', Session::get('mail'))
            ->first() : ModelsPengguna::where('id_pengguna', $id)
            ->first();

        return view('pengguna.profil', compact('user'));
    }

    public function edit()
    {
        $user = ModelsPengguna::where('alamat_email', Session::get('mail'))
            ->first();

        return view('pengguna.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'gambar' => 'mimes:jpeg,png,bmp,tiff,jfif |max:4096',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only jpeg, png, bmp,tiff are allowed.'
            ]
        );

        $img = $request->all();

        if ($image = $request->file('gambar')) {
            $destinationPath = 'user/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $img = $profileImage;
        } else {
            unset($img['gambar']);
        }
        
        $user = ModelsPengguna::where('alamat_email', Session::get('mail'))
            ->update([
                "nama" => $request->nama,
                "alamat_email" => $request->email,
                "deskripsi" => $request->deskripsi,
                "gambar" => $img
            ]);

        $user = ModelsPengguna::where('alamat_email', $request->email)->first();
        
        Session::flush();

        $nama = explode(" ", $user->nama);
        $nama = $nama[0];
        Session::put('mail', $user->alamat_email);
        Session::put('namae', $nama);
        Session::put('img', $user->gambar);
        Session::put('login', TRUE);


        return redirect('/profile')->with('alert-success', 'Profile Updated!');
    }
}
