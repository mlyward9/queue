<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQueue extends Model
{
    use HasFactory;

    protected $table = 'form_queue';

    protected $fillable = ['name', 'gender', 'purpose', 'status', 'completed'];

    protected $casts = [
        'purpose' => 'array', // Ensure JSON is cast as an array
        'completed' => 'boolean',
    ];
}
