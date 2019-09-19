<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patients extends Model
{ 

    use Notifiable;
    
	protected $fillable = [
		'patient_id','fname','lname','mname','age','birthdate','birthorder','address_id','contact','gender','civil_status','nationality','religion','patient_type','jail','caseno','status','date_admitted','department_id','flag',
	];

	 public function departments()
    {
        return $this->belongsTo('App\Departments','department_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Address','address_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Case_Type','patient_type');
    }

    public function jails()
    {
        return $this->belongsTo('App\City_Jails','jail');
    }

}
