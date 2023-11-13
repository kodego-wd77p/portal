<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    public $timestamps = false;

    protected $fillable = [
            'title',
            'description',
            'file',
            'activity_status_id',
            'owner'

        ];
}
