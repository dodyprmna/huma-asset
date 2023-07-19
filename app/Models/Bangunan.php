<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function file(): HasMany
    {
        return $this->hasMany(FileBangunan::class, 'id_bangunan');
    }
}
