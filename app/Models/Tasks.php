<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = ['board_id', 'title', 'description', 'priority', 'ultimatum', 'color'];

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
    
        public function lobby()
    {
        return $this->belongsTo(Board::class);
    }
}
