<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;
    use HasUuids;
    public $timestamps = false;
    public $fillable = [
        'localname',
        'latitude',
        'longitude',
        'category_id',
    ];
}
