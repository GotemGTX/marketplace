<?php

namespace App\Http\Controllers\Freelancer;

use App\Bookmark;
use App\Company;
use App\Http\Controllers\Controller;
use App\Mission;
use App\order;
use App\orderDeliver;
use App\SourceBookmark;
use App\User;
use DB;

class FreelancerController extends Controller {
    public function __construct() {
        $this->middleware('auth', ['except' => ['showRegister']]);
    }

    public function showRegister() {
        return view('auth.freelancerregister');
    }

    public function dashboard() {
        if (!$this->checkAuthorization()) {
            // dd('here');
            return redirect()->route('employer.dashboard');
        }
        $missions = Mission::where('status', 0)->paginate(5);
        return view('freelancer.dashboard', compact('missions'));
    }

    public function browsemission() {
        $companies = Company::all();
        $missions = Mission::paginate(10);
        return view('freelancer.browse-mission', compact('missions', 'companies'));
    }

    public function messages() {
        return view('freelancer.messages');
    }

    public function balance() {
        // $balance = 0;
        // $orders = DB::table('orders')->where('applicant_id', \Auth::id())->where('status', 'accepted')->get();
        // foreach ($orders as $order) {
        //     $balance += $order->amount;
        // }

        $balance = 0;
        $withdraw = 0;

        $orders = DB::table('orders')->where('applicant_id', \Auth::id())->where('status', 'accepted')->get();
        foreach ($orders as $order) {
            $balance += $order->amount;
        }

        $withdraws = DB::table('withdraw_history')->where('user_id', \Auth::id())->where('status', '!=', 'rejected')->get();
        foreach ($withdraws as $withdrawl) {
            $withdraw += $withdrawl->amount;
        }
        $userBalance = $balance - $withdraw - ($balance * .2);

        return view('freelancer.balance', ['balance' => $userBalance]);
    }

    public function crowdfund() {
        return view('freelancer.crowdfund');
    }

    public function saved() {
        $saved = Bookmark::where('user_id', \Auth::id())->get();
        $sourcesaved = SourceBookmark::where('user_id', \Auth::id())->get();

        return view('freelancer.saved', compact('saved', 'sourcesaved'));
    }

    public function personal() {
        // dd(auth()->user()->user_type);
        if (auth()->user()->user_type == User::USER_FREELANCER) {
            $route = 'freelancer.dashboard';
        } elseif (auth()->user()->user_type == User::USER_EMPLOYER) {
            $route = 'employer.dashboard';
        }
        $user = \Auth::user();
        if (!$user->is_verified) {
            return redirect()->route($route)->with('error', 'Verify your idenity first');
        }
        return view('freelancer.personal', ['user' => $user]);
    }

    public function settings() {
        return view('freelancer.settings');
    }

    public function group_chat() {
        return view('freelancer.group_chat');
    }

    public function participated() {
        $items = DB::table('crowd_funding')->where('user_id', \Auth::id())->get();
        return view('freelancer.participated', compact('items'));
    }

    public function checkAuthorization() {
        if ((int) auth()->user()->user_type !== \App\User::USER_FREELANCER) {
            // dd('here');
            return false;
        } else {
            return true;
        }
    }

    public function myJobs() {
        $myJobs = DB::table('orders')->where('applicant_id', \Auth::id())->where('status', 'completed')->get();
        // dd($myJobs);
        return view('freelancer.my-jobs', compact('myJobs'));
    }

    public function submitwork() {
        // dd(request()->all());
        request()->validate([
            'orderid' => 'required',
        ]);
        $order = order::find(request('orderid'));
        $order->status = 'delivered';
        $order->save();
        $data = new orderDeliver();
        $data->description = request('desc');
        $data->order_id = request('orderid');
        // dd('asdasdasdas');
        if (request()->hasFile('file')) {

            $filenameWithExt = request('file')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = request('file')->getClientOriginalExtension();
            // dd($extension);

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $filePath = request('file')->storeAs('public/files/deliveries', $fileNameToStore);

            $data->file = $fileNameToStore;

        }

        $data->save();
        // dd('hed');
        return back()->with('success', 'Order deliverd successfully');

    }

}
