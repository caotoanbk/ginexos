<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Osstatistic extends Model
{
	protected $fillable = ['osid', 'ngay_lam', 'gc', 'tc', 'gc1', 'tc1', 'gc2', 'tc2', 'day_type'];
	public $timestamps = false;
}
