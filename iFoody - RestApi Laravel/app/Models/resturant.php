<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resturant extends Model
{
    use HasFactory;

  protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'image',
        'image2',
        'image3',
        'availability',
        'approval',
        'manger_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
