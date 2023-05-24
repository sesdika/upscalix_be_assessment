<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IanaTimezone extends Model
{
    use HasFactory;

    protected $fillable = ['tz_identifier', 'std_utc_offset', 'dst_utc_offset'];
}
