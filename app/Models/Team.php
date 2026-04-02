<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'designation',
        'email',
        'phone',
        'image',
        'qualification',
        'location',
        'age',
        'gender',
        'social_links',
        'bio',
        'status',
        'featured',
        'addedby_id',
        'editedby_id',
        'drag_id'
    ];

    protected $casts = [
        'social_links' => 'array',
        'status'       => 'boolean',
        'featured'     => 'boolean',
    ];

}
