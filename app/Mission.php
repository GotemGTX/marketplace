<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class,'mission_company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
