<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $fillable = [
        'department_name','description','flag',
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
