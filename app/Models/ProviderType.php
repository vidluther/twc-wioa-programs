<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    use HasFactory;
    protected $guarded = [];

    /*
     * A providertype has many providers..
     */
    public function providers() {
        return $this->hasMany(Provider::class);
    }
}
