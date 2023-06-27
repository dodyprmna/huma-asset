<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use SoftDeletes;
    protected $table        = 'level';
    protected $primarykey   = 'id_level';
}
