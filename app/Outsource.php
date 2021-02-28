<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outsource extends Model
{
	protected $fillable = ['maos', 'congty','cmt', 'ngaycap', 'noicap', 'hoten', 'pic', 'ngayvao', 
	'line', 'bophan', 'songaydklv', 'ngayhethd', 'ngaynghi', 'sotaikhoan', 'tentaikhoan', 'nganhang'];
}
