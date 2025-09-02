<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class MxCompany extends Model
{
    protected $connection = 'mysql_mx';
    protected $table = 'companies';
    public $timestamps = false;
    protected $fillable = ['state_id','slug','name','brand_name','address'];

    public function state()
    {
        return $this->belongsTo(MxState::class, 'state_id');
    }
}
