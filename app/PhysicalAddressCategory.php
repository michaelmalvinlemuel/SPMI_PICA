<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhysicalAddressCategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'physical_address_categories';
    protected $dates = ['deleted_at'];
    
    
}
