<?php

namespace App\Http\Controllers;
use App\Mission;
use App\project;
use DB;
use Session;

class OrderController extends Controller {
    public function success() {
        // dd('here');
        session_start();

        if (isset($_SESSION['crowdfund']) && $_SESSION['crowdfund'] == 'true') {
            $_SESSION['crowdfund'] == 'false';
            $mission = $_SESSION['crowdfund_mission_id'];
            $amount = $_SESSION['crowdfund_amount'];
            $user = \Auth::id();

            $data = [
                'mission_id' => $mission,
                'user_id' => $user,
                'amount' => $amount,
            ];

            DB::table('crowd_funding')->insert($data);

            return back()->with('success', 'Participated in crowdfunding successfully');

        } else {
            $app_id = $_SESSION['applicant_id'];
            $orderId = $_SESSION['c_order_id'];
            $project_id = $_SESSION['project_id'];

            $offer = project::where('id', $project_id)->first();
            $offer->status = 'accepted';
            $offer->save();

            $data = [
                'order_id' => $orderId,
                'applicant_id' => $app_id,
                'project_id' => $project_id,
                'status' => 'completed',
                'amount' => $_SESSION['mission_amount'],
            ];

            $mission = Mission::find($offer->mission_id);
            $mission->status = true;
            $mission->save();
            // dd($data);
            DB::table('orders')->insert($data);
            Session::put('success', 'Funded Successfully');
            return redirect()->route('employer.dashboard');
        }

    }
}
