<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Report;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function index() {
        $reports = Report::get();

        foreach($reports as $rep) {
            $thread = Thread::where("id_thread", $rep->id_thread)->first();
            $rep->thread = $thread;
        }

        return view("admin.index", compact("reports"));
    }

    public function login() {
        return view('admin.login');
    }

    public function logged(Request $request) {
        $logged = Admin::where("username", $request->username)
            ->where("password", $request->password)->first();

        Session::put('admin', TRUE);
        return redirect('/dashboard');
    }

    public function bann($id) {
        Thread::where("id_thread", $id)->update(["status" => "banned"]);
        Report::where("id_thread", $id)->delete();

        return redirect('/dashboard')->with('alert-success', 'Report solved 3:)');
    }
}
