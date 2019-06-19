<?php

namespace App\Http\Controllers;

use App\Jobs\SendSms;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessagingController extends Controller
{

    /**
     * the current authenticated user
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function dashboard() {
        return view('messaging');
    }

    public function handle(Request $request) {
        Message::create(array(
            "user_id" => Auth::user()->id,
            "content" => $request->input('message')
        ));

        if(substr(Auth::user()->name, 0, 3) === "Coa" || substr(Auth::user()->name, 0, 3) === "Adm") {
            SendSms::dispatch('YOUR-NUMBER-HERE', $request->input('message'));
        }

        return redirect('/dashboard');
    }

}
