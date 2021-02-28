<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wclient extends Model
{
	protected $fillable = ['WclientsName', 'WclientsCode','WclientsLink'];
	public $timestamps = false;
}
