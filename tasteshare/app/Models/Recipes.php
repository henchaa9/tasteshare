<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upvote;

class Recipes extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function isUpvotedByUser()
    {
        // Check if the authenticated user has upvoted the recipe
        return $this->upvotes()->where('userid', auth()->id())->exists();
    }

    public function upvotes()
    {
        return $this->hasMany(Upvote::class, 'recipeid');
    }
}
