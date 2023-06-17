<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory;

    public function endorsements()
    {
        return $this->hasMany(Endorsements::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
