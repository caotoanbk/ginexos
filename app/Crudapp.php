<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crudapp extends Model
{
    protected $fillable = ['CrudappsName', 'CrudappsDescription'];
    public $timestamps = false;
}
