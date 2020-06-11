<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model {
    public function country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
