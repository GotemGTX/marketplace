<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class SourceBookmark extends Model {
    protected $fillable = [];
    public function isBookmarked($id) {
        $check = DB::table('source_bookmarks')->where('source_id', $id)->where('user_id', \Auth::id())->first();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }

    protected $table = 'source_bookmarks';
}
