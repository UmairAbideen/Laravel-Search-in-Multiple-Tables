<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'make', 'model'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
