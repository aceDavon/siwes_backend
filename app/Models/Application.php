<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "opening_id"
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function opening()
    {
        return $this->belongsTo(Opening::class);
    }
}
