<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Bangunan;

class Unit extends Model
{
    use SoftDeletes;
    protected $table        = 'call_center';
    protected $primaryKey   ='id_call_center';
    
    public function bangunan(): HasMany
    {
        return $this->hasMany(Bangunan::class, 'id_call_center');
    }
}
