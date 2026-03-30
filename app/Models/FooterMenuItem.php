<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterMenuItem extends Model
{
    protected $fillable = [
        'title',
        'url',
        'section',
        'opens_in_new_tab',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'opens_in_new_tab' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
