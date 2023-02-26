<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'lable',  
        'status',
        'created_by',
        'set_status_by', 
    ];

    // public function createdBy()
    // {
    //     return $this->belongsTo('App\Models\User','created_by');
    // }
    // public function statusBy()
    // {
    //     return $this->belongsTo('App\Models\User','set_status_by');
    // }
}
