<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'start',
        'end',
    ];

    /**
     * Get the user that created the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
