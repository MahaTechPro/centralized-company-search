<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class MxReport extends Model
{
    protected $connection = 'mysql_mx';
    protected $table = 'reports';
    public $timestamps = false;
    protected $fillable = ['name','info','order','default','status'];
}
