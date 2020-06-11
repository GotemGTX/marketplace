<?php

namespace App\Http\Controllers;
use App\Mission;
use App\Profile;
use App\User;
use DB;

class AdminController extends Controller {
    public function __construct() {
        $this->middleware('web')->except(['adminlogin']);
    }

    public function adminlogin() {
        return view('admin.login');
    }

    public function admindashboard() {
        $this->authorizeUser();
        return view('admin.dashboard');
    }

    public function adminall_users() {
        $this->authorizeUser();
        $users = User::all();

        return view('admin.all_users', ['users' => $users]);
    }

    public function adminall_cases() {
        $this->authorizeUser();
        $missions = Mission::orderByDesc('created_at')->get();

        return view('admin.all_cases', ['missions' => $missions]);
    }

    public function adminverify_request() {
        $this->authorizeUser();

        $requests = Profile::where('verification_submitted', true)->where('verification_status', 'pending')->get();

        return view('admin.verify_request', ['requests' => $requests]);
    }

    public function adminverify_profile(Profile $profile) {

        $this->authorizeUser();
        return view('admin.verify_profile', ['profile' => $profile]);
    }

    public function admin_approve_verified_account(Profile $profile) {

        $this->authorizeUser();
        $profile->verification_status = 'verified';
        $profile->save();
        $user = User::find($profile->user_id);

        $user->is_verified = true;
        $user->save();

        return redirect()->route('identity.requests')->with('success', 'Verified Successfully');
    }

    public function adminverified_account() {
        $this->authorizeUser();
        $verified_users = User::where('is_verified', true)->get();

        return view('admin.verified_account', ['users' => $verified_users]);
    }

    public function withdrawRequests() {
        $requests = DB::table('withdraw_history')->get();
        return view('admin.withdraw_requests', compact('requests'));
    }

    public function authorizeUser() {
        // dd(auth()->user()->user_type != 0);
        if (\Request::segment(1) == 'admin' && \Request::segment(2) == 'login') {
            return true;
        } elseif (auth()->user()->user_type != 0) {
            // dd('you are not authorized to see this page');
        }
    }

    public function acceptWithdrawRequest($id) {

        DB::table('withdraw_history')->where('id', $id)->update(['status' => 'accepted']);
        return back()->with('success', 'Withdraw request accepted successfully');
    }

    public function rejectWithdrawRequest($id) {

        DB::table('withdraw_history')->where('id', $id)->update(['status' => 'rejected']);
        return back()->with('error', 'Withdraw request rejected successfully');
    }

}
