<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;


class resturant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Prunable;

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

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek(2));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
