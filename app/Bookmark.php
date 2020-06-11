<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model {
    public function isBookmarked($id) {
        $check = DB::table('bookmarks')->where('mission_id', $id)->where('user_id', \Auth::id())->first();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }
}
