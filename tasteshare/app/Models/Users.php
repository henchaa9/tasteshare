<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Model
{
    use HasFactory;


    public function recipes()
    {
        return $this->hasMany(Recipes::class, 'userid');
    }

}
