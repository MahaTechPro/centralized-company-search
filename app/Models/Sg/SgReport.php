<?php

namespace App\Models\Sg;

use Illuminate\Database\Eloquent\Model;

class SgReport extends Model
{
    protected $connection = 'mysql_sg';
    protected $table = 'reports';
    public $timestamps = false; // adjust if SG has timestamps
    protected $fillable = ['name','info','order','default','status','price'];
}
