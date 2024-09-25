<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local_detail extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'local_id',
        'photo2',
        'summary',
        'url',
        'create_date',
        'update_date',
        'completed_at',
        'user_id',
    ];
}
