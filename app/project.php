<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model {
    protected $guarded = [];

    public function applicant() {
        return $this->belongsTo(User::class, 'applicant_id');
    }
}
