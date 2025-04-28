<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasFactory;

    protected $fillable = ['group_id', 'name'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
