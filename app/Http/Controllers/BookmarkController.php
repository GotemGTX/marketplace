<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\SourceBookmark;
use DB;
use Illuminate\Http\Request;

class BookmarkController extends Controller {
    public function bookmark() {
        $missionId = request('mission_id');
        $data = [
            'mission_id' => $missionId,
            'user_id' => \Auth::id(),
        ];

        $chk = DB::table('bookmarks')->where('user_id', \Auth::id())->where('mission_id', request('mission_id'))->first();
        if (!$chk) {
            DB::table('bookmarks')->insert($data);
        }

        return response()->json('bokmarked');
    }

    public function unbookmark() {
        $missionId = request('mission_id');
        $userId = \Auth::id();

        Bookmark::where('user_id', $userId)->where('mission_id', $missionId)->delete();

        return response()->json('bokmark removed');
    }

    public function deleteBookmark($id) {
        $bookmark = Bookmark::find($id);
        $bookmark->delete();

        return back()->with('success', 'Bookmark deleted successfully');
    }

    public function sourceBookmark() {
        $sourceId = request('source_id');
        $data = [
            'source_id' => $sourceId,
            'user_id' => \Auth::id(),
        ];

        $chk = DB::table('source_bookmarks')->where('user_id', \Auth::id())->where('source_id', request('source_id'))->first();
        if (!$chk) {
            DB::table('source_bookmarks')->insert($data);
        }

        return response()->json('bokmarked');
    }

    public function sourceUnbookmark() {
        $sourceId = request('source_id');
        $userId = \Auth::id();

        SourceBookmark::where('user_id', $userId)->where('source_id', $sourceId)->delete();

        return response()->json('bokmark removed');
    }

    public function deleteSourceBookmark($id) {
        $bookmark = SourceBookmark::find($id);
        $bookmark->delete();

        return back()->with('success', 'Bookmark deleted successfully');
    }
}
