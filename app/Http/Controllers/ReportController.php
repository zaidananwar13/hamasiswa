<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Report;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function thread($id) {
        $thread = Thread::where('id_thread', $id)->first();
        return view('report.report', compact("thread"));
    }

    public function threadBan(Request $request) {
        $reporter = Pengguna::where("alamat_email", Session::get("mail"))
            ->first();

        $report = new Report();
        $report->id_thread = $request->thread;
        $report->reporter = $reporter->id_pengguna;
        $report->laporan = $request->laporan;
        $report->status = "pending";
        $report->save();

        return redirect('/thread/' . $request->thread)->with('alert-success', 'Thread report dikirimkan!');
    }
}
