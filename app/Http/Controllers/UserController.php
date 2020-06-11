<?php

namespace App\Http\Controllers;

use App\Country;
use App\EmploymentHistory;
use App\Profile;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function profile() {
        $countries = Country::all();

        $profile = Profile::where('user_id', Auth::User()->id)->first();
        return view('general.profile', ['countries' => $countries, 'profile' => $profile]);
    }

    public function storeProfile(Request $request) {
        // dd($request->all());

        $profile = Profile::where('user_id', Auth::User()->id)->first();

        if (!$profile) {
            request()->validate([
                'name' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'hourly_rate' => 'required',
            ]);
        } else {
            request()->validate([
                'name' => 'required',
                'hourly_rate' => 'required',
            ]);
        }

        if (request()->hasFile('resume')) {

            request()->validate([
                'resume' => 'required',
            ]);

            $filenameWithExt = request('resume')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = request('resume')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $resumePath = request('resume')->storeAs('public/files/resume', $fileNameToStore);

        }

        if (request()->hasFile('cover_letter')) {

            request()->validate([
                'cover_letter' => 'required',
            ]);

            $filenameWithExt = request('cover_letter')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = request('cover_letter')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $coverPath = request('cover_letter')->storeAs('public/files/coverletter', $fileNameToStore);

        }

        if (request()->hasFile('avatar')) {

            request()->validate([
                'avatar' => 'required|image|mimes:jpg,jpeg,png',
            ]);

            $filenameWithExt = request('avatar')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = request('avatar')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $avatarPath = request('avatar')->storeAs('public/files/avatars', $fileNameToStore);

        }

        if (!$profile) {
            $profile = new Profile();

            $profile->name = request('name');
            $profile->country_id = request('country');
            $profile->state_id = request('state');
            $profile->city_id = request('city');
            $profile->hourly_rate = request('hourly_rate');
            if (request()->hasFile('resume')) {
                $profile->resume = $resumePath;
            }
            if (request()->hasFile('avatar')) {
                $profile->avatar = $avatarPath;
            }
            if (request()->hasFile('cover_letter')) {
                $profile->cover_letter = $coverPath;
            }
            $profile->user_id = \Auth::id();

            $profile->about = request('about');

            $profile->save();

        } else {
            $profile = Profile::where('user_id', \Auth::id())->first();

            $profile->name = request('name');
            if (request('country')) {
                $profile->country_id = request('country');
            }
            if (request('state')) {
                $profile->state_id = request('state');
            }
            if (request('city')) {
                $profile->city_id = request('city');
            }
            $profile->hourly_rate = request('hourly_rate');

            if (request()->hasFile('resume')) {
                $profile->resume = $resumePath;
            }
            if (request()->hasFile('avatar')) {
                $profile->avatar = $avatarPath;
            }
            if (request()->hasFile('cover_letter')) {
                $profile->cover_letter = $coverPath;
            }
            $profile->user_id = \Auth::id();

            $profile->about = request('about');

            $profile->save();
        }
        return back()->with('success', 'Profile Updated Successfully');
    }

    public function storeIdentity(Request $request) {
        request()->validate([
            'passport' => 'required|mimes:jpg,jpeg,png',
            'driving_license' => 'required|mimes:jpg,jpeg,png',
        ]);

        $profile = Profile::where('user_id', \Auth::id())->first();
        if (!$profile) {
            return back()->with('error', 'Please add personal info first');
        }

        if (request()->hasFile('passport')) {

            $filenameWithExt = request('passport')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = request('passport')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $passportPath = request('passport')->storeAs('public/files/users/identity', $fileNameToStore);

        }
// dd($passportPath);
        if (request()->hasFile('driving_license')) {

            $filenameWithExt = request('driving_license')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = request('driving_license')->getClientOriginalExtension();

            $fileNameToStore = $filename . '-' . time() . '.' . $extension;

            $driving_licensePath = request('driving_license')->storeAs('public/files/users/identity', $fileNameToStore);

        }

        $profile->passport = $passportPath;
        $profile->driving_license = $driving_licensePath;
        $profile->verification_submitted = true;

        $profile->save();

        return back()->with('success', 'Documents Submitted for verification successfully');

    }

    public function storeEmpHistory() {
        // dd(request()->all());
        // dd(date('Y-m-d'),request('from'));

        request()->validate([
            'title' => 'required',
            'company' => 'required',
            'from' => 'required',
            'description' => 'required',
        ]);

        if (!request('currently_working_here')) {
            request()->validate([
                'to' => 'required',
            ]);
        }

        $history = new EmploymentHistory();
        $history->job_title = request('title');
        $history->user_id = \Auth::id();
        $history->company = request('company');
        $history->from = request('from');
        if (request('currently_working_here')) {
            $history->to = date('Y-m-d');
        } else {
            $history->to = request('to');
        }
        $history->description = request('description');

        $history->save();

        return back()->with('success', 'Employment History Updated Successfully');

    }

    public function showProfile(User $user) {
        $user = \Auth::user();
        if (!$user->is_verified) {
            return back()->with('error', 'Verify your idenity first');
        }
        return view('general.showprofile', ['user' => $user]);
    }
}
