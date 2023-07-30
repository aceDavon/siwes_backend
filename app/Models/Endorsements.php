<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endorsements extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_book_id',
        'remarks',
        'user_id'
    ];

    protected $hidden = [
        'id'
    ];

    public function logBook()
    {
        return $this->belongsTo(LogBook::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class);
    }
}
