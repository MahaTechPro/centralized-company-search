<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class MxReportState extends Model
{
    protected $connection = 'mysql_mx';
    protected $table = 'report_state';
    public $timestamps = false;
    protected $fillable = ['report_id','state_id','amount'];

    public function report()
    {
        return $this->belongsTo(MxReport::class, 'report_id');
    }

    public function state()
    {
        return $this->belongsTo(MxState::class, 'state_id');
    }
}
