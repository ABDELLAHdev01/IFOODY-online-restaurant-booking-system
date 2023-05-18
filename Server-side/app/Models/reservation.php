<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resturant_id',
        'table_id',
        'date',
        'time',
        'duration',
        'number_of_people',
        'status',
        'approval',
        'phone',
        'email',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resturant()
    {
        return $this->belongsTo(resturant::class);
    }
}
