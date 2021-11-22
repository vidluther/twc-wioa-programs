<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $guarded = [];


    /*
        A provider can only be of one type. or Belongs to one Provider type.
    */
    public function provider_type()
    {
        return $this->belongsTo(ProviderType::class);
    }
}
