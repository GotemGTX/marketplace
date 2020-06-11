<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Company;
use App\Milestone;
use App\Mission;
use App\project;
use App\User;
use DB;
use Illuminate\Http\Request;

class Main_Ctrl extends Controller {

    public function search() {
        // dd(request()->all());
        $country = request('country');
        $company = request('company');
        $missiontype = request('missiontype');
        $fundingtype = request('fundingtype');
        $range = explode(',', request('range'));
        $min = (int) $range[0];
        $max = (int) $range[1];
        // dd($min, $max);
        // DB::EnableQueryLog();
        $missions = Mission::where('estimated_budget', '>=', $min)->where('estimated_budget', '<=', $max)->where('status', 0);

        if (request('missiontype')) {
            if (in_array('private', $missiontype)) {
                $missions->where('mission_privacy', 'private');

                if (!in_array('private', $missiontype) && in_array('public', $missiontype)) {
                    $missions->where('mission_privacy', 'public');
                }

                if (in_array('private', $missiontype) && in_array('public', $missiontype)) {
                    $missions->orWhere('mission_privacy', 'public');
                }
            }
        }

        if (request('company')) {
            $missions->where('mission_company_id', (int) $company);
        }
        // dd($missions->paginate(10));
        // $missions = collect($missions);
        $missions = $missions->paginate(10);
        $companies = Company::all();

        return view('freelancer.browse-mission', compact('missions', 'companies'));

    }
    public function showMission($slug) {
        // dd('here');
        $data = explode('-', $slug);
        $mission_id = end($data);
        $mission = Mission::findOrFail($mission_id);
        // dd($mission);
        return view('general.single-mission-case', ['mission' => $mission]);
    }

    public function applyMission(Mission $mission) {
        // dd(request()->all());
        request()->validate([
            'message' => 'required',
        ]);
        if (request('make_offer')) {
            request()->validate([
                'offer_amount' => 'required|integer',
            ]);
        }
        if (request('milestone')) {
            request()->validate([
                'milestone' => 'required',
                'amount' => 'required',
            ]);
        }

        $is_applied = Applicant::where('mission_id', $mission->id)->where('applicant_id', \Auth::id())->first();

        if ($is_applied) {
            return back()->with('error', 'You have already applied');
        }
        $is_verified = auth()->user()->is_verified;
        // dd();

        if (!(boolean) $is_verified) {
            return back()->with('error', 'Please verify your identity first');
        }
        $is_freelancer = auth()->user()->user_type == \App\User::USER_FREELANCER ? true : false;

        if (!$is_freelancer) {
            return back()->with('error', 'You are not authorized to apply');
        }

        DB::beginTransaction();
        // if(!$is_applied && $is_verified && $is_freelancer){
        $project = new project();
        $project->employer_id = $mission->user_id;
        $project->mission_id = $mission->id;
        $project->applicant_id = \Auth::id();
        $project->message = request('message');
        if (request('make_offer')) {
            $project->is_offer = true;
            $project->offer_amount = request('offer_amount');
        }

        if (request('milestones')) {
            $project->is_milestone = true;
            $project->save();
            // dd($project->id);

            $milestones = request('milestone');
            $amount = request('amount');
// dd($milestones);
            foreach ($milestones as $key => $value) {
                $milestoneModel = new Milestone();
                $milestoneModel->project_id = $project->id;
                $milestoneModel->milestone_title = $value;
                $milestoneModel->milestone_amount = $amount[$key];
                $milestoneModel->save();
                // dd($milestoneModel);
            }
        }
        if (!request('is_milestone')) {
            $project->save();
        }

        $applicant = new Applicant();
        $applicant->mission_id = $mission->id;
        $applicant->employer_id = $mission->user_id;
        $applicant->applicant_id = \Auth::id();
        $applicant->save();
        // }
        DB::commit();
        return redirect()->route('freelancer.dashboard')->with('success', 'Application submitted successfully');
    }

    public function settings() {
        return view('general.settings');
    }

    public function postsettings() {
        $user = auth()->user();
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'unique:users,email,' . $user->id,
            'account_type' => 'required',
        ]);

        $user->name = request('first_name') . ' ' . request('last_name');
        $user->email = request('email');
        $user->user_type = request('account_type');
        $user->save();

        return back()->with('success', 'Settings saved successfully');
    }

    public function withdraw() {
        request()->validate([
            'amount' => 'required|numeric',
        ]);

        if (request('amount') < 10) {
            return back()->with('error', 'Min amount is 10 to withdraw');
        }

        if (auth()->user()->user_type == User::USER_FREELANCER) {
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

            if ($userBalance < request('amount')) {
                return back() > with('error', 'Insufficient funds');
            }

            DB::table('withdraw_history')->insert(['user_id' => \Auth::id(), 'amount' => request('amount'), 'hash' => request('hash')]);

            return back()->with('success', 'Withdraw Request sent successfully');
        }
    }
}
