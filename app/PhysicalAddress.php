<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhysicalAddress extends Model
{
    use SoftDeletes;
    
    protected $table = 'physical_addresses';
    protected $dates = ['deleted_at'];
    
    public function physicalAddress() {
        return $this->belongsTo('App\PhysicalAddress');
    }
    
    public function physicalAddressCategory() {
        return $this->belongsTo('App\PhysicalAddressCategory');
    }
    
}
