<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Unit;

class Bangunan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bangunan';
    protected $primaryKey = 'id_bangunan';

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'id_call_center');
    }
}
