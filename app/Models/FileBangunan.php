<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileBangunan extends Model
{
    use HasFactory;

    protected $table = 'file_bangunan';
    protected $primaryKey = 'id_file_bangunan';

    public function bangunan(): BelongsTo
    {
        return $this->belongsTo(Bangunan::class, 'id_bangunan');
    }
}
