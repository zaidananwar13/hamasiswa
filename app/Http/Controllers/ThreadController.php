<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\SubThread;
use App\Models\Thread;
use App\Models\ThreadLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThreadController extends Controller
{
    public function main()
    {
        $thread = Thread::where("status", "!=", 'banned')->latest()->paginate(3);
        foreach($thread as $t) {
            $t->likes = count(ThreadLike::where("thread", $t->id_thread)->get());
        } 
        return view('index', compact('thread'));
    }

    public function index()
    {
        $thread = Thread::where("status", "!=", 'banned')->latest()->paginate(3);
        foreach($thread as $t) {
            $t->likes = count(ThreadLike::where("thread", $t->id_thread)->get());
        } 
        return view('thread.index', compact('thread'));
    }

    public function show($id)
    {
        $thread = Thread::where("status", "!=", 'banned')->where('id_thread', $id)->first();
        $pengguna = Pengguna::where('id_pengguna', $thread->threadStarter)
            ->first();
        $pengguna->thread = count(Thread::where("status", "!=", 'banned')->where('threadStarter', $pengguna->id_pengguna)->get());
        $pengguna->subThread = count(SubThread::where("status", "!=", 'banned')->where('subThreader', $pengguna->id_pengguna)->get());

        $thread->threadStarter = $pengguna;
        $thread->subThread = SubThread::where("status", "!=", 'banned')->where("id_thread", $id)->get();
        $thread->likes = count(ThreadLike::where("thread", $thread->id_thread)->get());
        $thread->liked = false;

        $realPengguna = Pengguna::where("alamat_email", Session::get("mail"))->first();

        $status = ThreadLike::where("thread", $thread->id_thread)->where("id_pengguna", $realPengguna->id_pengguna)->first();

        if($status) {        
            $thread->liked = true;
        }

        foreach($thread->subThread as $subThread) {
            $subThread->subThreader = Pengguna::where('id_pengguna', $subThread->subThreader)->first();
        }

        $thread->status = true;

        return view('thread.show', compact('thread'));
    }

    public function reply(Request $request, $id_thread) {
        $subThreader = Pengguna::where("alamat_email", $request->user)->first();

        if($subThreader) {
            $rethread = new SubThread();
            $rethread->id_thread = $id_thread;
            $rethread->subThreader = $subThreader->id_pengguna;
            $rethread->konten = $request->konten;
            $rethread->status = ($request->status == "thread") ? "thread" : "subthread";

            if($rethread->save()) {
                return redirect("/thread/" . $id_thread)->with('alert-success', 'Comment Added!');
            }
        }

        echo "something went wrong :)";
    }

    public function create() {
        return view("thread.add");
    }

    public function addpost(Request $request) {
        $ts = Pengguna::where("alamat_email", Session::get("mail"))->first();

        $thread = new Thread();
        $thread->threadStarter = $ts->id_pengguna;
        $thread->judul = $request->judul;
        $thread->konten = $request->content;
        $thread->likes = 0;

        if($thread->save()) return redirect("/beranda")->with("alert-success", "Post added!");
    }

    public function edit($id) {
        $user = Pengguna::where("alamat_email", Session::get('mail'))
            ->first();
        if(!$user) {
            return redirect('/beranda')->with('alert-danger', 'Mau ngapain lu? >:(');
        }

        $thread = Thread::where("status", "!=", 'banned')->where('threadStarter', $user->id_pengguna)
            ->where('id_thread', $id)
            ->first();
                        
        return view('thread.edit', compact('thread'));
    }

    public function putpost(Request $request) {
        $user = Pengguna::where("alamat_email", Session::get('mail'))
            ->first();
        if(!$user) {
            return redirect('/beranda')->with('alert-danger', 'Mau ngapain lu? >:(');
        }

        var_dump($request->all());

        $thread = Thread::where("status", "!=", 'banned')->where('threadStarter', $user->id_pengguna)
            ->where('id_thread', $request->thread)
            ->update([
                'judul' => $request->judul,
                'konten' => $request->content
            ]);

        if($thread) {
            return redirect('/thread/' . $request->thread)->with('alert-success', 'Thread Updated :)');
        }

        return redirect('/thread/' . $request->thread)->with('alert-danger', 'Can\'t update thread :(');
    }

    public function like(Request  $request, $type) {
        switch($type) {
            case "thread":
                return $this->threadLike($request);
        }
    }

    public function unlike(Request  $request, $type) {
        switch($type) {
            case "thread":
                return $this->threadUnLike($request);
        }
    }

    private function threadLike(Request $request) {
        $user = Pengguna::where("alamat_email", $request->user)->first();
        $threadLiked = ThreadLike::where("thread", $request->thread)
            ->where("id_pengguna", $user->id_pengguna)->first();

        if(!$threadLiked) {
            $threadLiked = new ThreadLike();
            $threadLiked->thread = $request->thread;
            $threadLiked->id_pengguna = $user->id_pengguna;
            $threadLiked->status = "thread";
            $threadLiked->save();
        }
        $threadLiked = ThreadLike::where("thread", $request->thread)->get();

        header('Content-Type: application/json; charset=utf-8');
        return response([
            "like" => count($threadLiked),
        ], 200);
    }

    private function threadUnLike(Request $request) {
        $user = Pengguna::where("alamat_email", $request->user)->first();
        $threadLiked = ThreadLike::where("thread", $request->thread)
            ->where("id_pengguna", $user->id_pengguna)->delete();

        $threadLiked = ThreadLike::where("thread", $request->thread)->get();

        header('Content-Type: application/json; charset=utf-8');
        return response([
            "like" => count($threadLiked),
        ], 200);
    }
}
