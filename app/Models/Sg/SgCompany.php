<?php

namespace App\Models\Sg;

use Illuminate\Database\Eloquent\Model;

class SgCompany extends Model
{
    protected $connection = 'mysql_sg';
    protected $table = 'companies';
    public $timestamps = false; // adjust if SG has timestamps
    protected $fillable = ['slug','name','brand_name','address'];
}
