<?php

namespace App\Http\Controllers\Employer;

use App\Bookmark;
use App\Company;
use App\Http\Controllers\Controller;
use App\Mission;
use App\order;
use App\project;
use App\SourceBookmark;
use App\User;
use DB;
use Illuminate\Http\Request;
use Image;

class EmployerController extends Controller {
    public function __construct() {
        $this->middleware('auth', ['except' => ['showRegister']]);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function dashboard() {
        if (!$this->checkAuthorization()) {
            return redirect()->route('freelancer.dashboard');
        }
        $missions = Mission::paginate(5);
        return view('employer.dashboard', compact('missions'));
    }

    public function uploadMission() {
        if (!$this->checkAuthorization()) {
            return redirect()->route('freelancer.dashboard');
        }
        $companies = Company::all();
        return view('employer.upload-mission', compact('companies'));
    }

    public function view_offer() {
        if (!$this->checkAuthorization()) {
            return redirect()->route('freelancer.dashboard');
        }
        $offers = project::where('employer_id', \Auth::id())->get();

        return view('employer.view_offer', ['offers' => $offers]);
    }

    public function postMission(Request $request) {
        $request->validate([
            'title' => 'required',
            'mission_type' => 'required',
            'mission_company' => 'required',
            'address' => 'required',
            'estimated_budget' => 'required',
            'deadline' => 'required',
            'mission_privacy' => 'required',
            'mission_description' => 'required',
            'mission_objective' => 'required',
            // 'min_raise_amount' => 'required',
            // 'max_raise_amount' => 'required',
            // 'mission_files' => 'required',
        ]);

        $mission = new Mission();
        DB::beginTransaction();
        $mission->title = $request->title;
        $mission->user_id = \Auth::id();
        $mission->mission_type = $request->mission_type;
        $mission->mission_company_id = $request->mission_company;
        if ($request->is_remote) {
            $mission->is_remote = true;
        }
        $mission->address = $request->address;
        $mission->estimated_budget = $request->estimated_budget;
        if ($request->is_urgent) {
            $mission->is_urgent = true;
        }
        $mission->deadline = $request->deadline;
        $mission->mission_privacy = $request->mission_privacy;
        $mission->mission_description = $request->mission_description;
        $mission->mission_objective = $request->mission_objective;
        if ($request->share_with_public) {
            $mission->files_share_with_public = true;
        }
        if ($request->enable_crowdfunding) {
            $mission->enable_crowdfunding = true;
        }
        if($request->min_raise_amount && $request->max_raise_amount) {
            $mission->min_raise_amount = $request->min_raise_amount;
            $mission->max_raise_amount = $request->max_raise_amount;
        }
        
        if ($request->allow_multiple_source_participate) {
            $mission->allow_multiple_source_participate = true;
        }

        $files = array();
        // $files[] = $f_image_name;
        if (request()->has('mission_files')) {
            $this->validate($request, [
                'mission_files.*' => 'mimes:jpg,jpeg,png|max:2000',
            ], [
                'mission_files.*.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
                'mission_files.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
            ]);

            foreach (request('mission_files') as $key => $value) {

                $img = Image::make(request('mission_files')[$key]);
                $thumb = Image::make(request('mission_files')[$key])->resize(300, 300);
                $imageName = uniqid() . time() . '.' . request()->mission_files[$key]->getClientOriginalExtension();
                $img->save(base_path() . '/public/images/missions_images/' . $imageName);
                $thumb->save(base_path() . '/public/images/missions_images/thumbs/' . $imageName);
                $files[] = $imageName;
            }
        }

        $files = json_encode($files);

        $mission->mission_files = $files;

        $mission->save();
        DB::commit();
        return back()->with('success', 'Mission Uploaded Successfully');

    }

    public function source() {
        $sources = User::where('user_type', User::USER_FREELANCER)->get();
        // dd($sources);
        return view('employer.source', ['sources' => $sources]);
    }

    public function messages() {
        return view('employer.messages');
    }

    public function saved() {
        $saved = Bookmark::where('user_id', \Auth::id())->get();
        $sourcesaved = SourceBookmark::where('user_id', \Auth::id())->get();
        return view('employer.saved', compact('saved', 'sourcesaved'));
    }

    public function crowdfund() {
        return view('employer.crowdfund');
    }

    public function personal() {
        // dd(auth()->user()->user_type);
        if (auth()->user()->user_type == User::USER_FREELANCER) {
            $route = 'freelancer.dashboard';
        } elseif (auth()->user()->user_type == User::USER_EMPLOYER) {
            $route = 'employer.dashboard';
        }
        $user = \Auth::user();
        // dd($user);
        if ($user->is_verified == 0) {

            return redirect()->route($route)->with('error', 'Verify your idenity first');
        }
        return view('employer.personal', ['user' => $user]);
    }

    public function settings() {
        return view('employer.settings');
    }

    public function participated() {
        $items = DB::table('crowd_funding')->where('user_id', \Auth::id())->get();
        return view('employer.participated', compact('items'));
    }

    public function group_chat() {
        return view('employer.group_chat');
    }

    public function checkAuthorization() {
        if ((int) auth()->user()->user_type !== \App\User::USER_EMPLOYER) {
            // dd('there');
            return false;
        } else {
            return true;
        }
    }

    public function balance() {
        return view('employer.balance');
    }

    public function myOrders() {
        $myOrders = [];
        $orders = DB::table('orders')->get();
        foreach ($orders as $order) {
            $project = project::where('id', $order->project_id)->first();
            if ($project->employer_id == \Auth::id()) {
                $myOrders[] = $order;
            }
        }

        // dd($myOrders);
        return view('employer.my-orders', compact('myOrders'));
    }

    public function acceptWork() {
        $orderid = request('orderid');
        $order = order::find($orderid);
        $order->status = 'accepted';
        $order->save();
        return back()->with('success', 'Accepted Successfully');
    }
}
