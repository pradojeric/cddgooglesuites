<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleSuite extends Model
{
    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'google_account', 'step_account', 'cdd_portal_account'
    ];

    protected $table = 'google_suites';

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }
}
