<?php

namespace App\Http\Controllers;
use App\project;

class AjaxController extends Controller {
    public function getOffer() {
        $offer_id = request('offer_id');
        $offer = project::find($offer_id);
        $html = view('modals.getoffer-modal', compact('offer'))->render();
        return $html;
    }
}
