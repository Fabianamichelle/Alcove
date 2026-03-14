<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // These are the only fields we allow to be mass-assigned
    protected $fillable = ['title', 'author', 'total_pages', 'current_page', 'notes', 'user_id'];

    // This links the book back to you (the Owner)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
