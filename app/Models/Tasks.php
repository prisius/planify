<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tasks extends Model
{
    protected $fillable = [
        'description',
        'task',
        'priority',
        'ultimatum',
        'color',
        'tags',
    ];
    

    protected $casts = [
        'tags' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming the foreign key is 'user_id'
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
