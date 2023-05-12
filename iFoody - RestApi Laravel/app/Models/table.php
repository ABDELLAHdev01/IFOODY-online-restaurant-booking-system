<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class table extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Prunable;

    protected $fillable = [
        'table_number',
        'table_capacity',
        'table_type',
        'status',
    ];

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek(2));
    }

    public function resturant()
    {
        return $this->belongsTo(resturant::class);
    }

    public function reservation()
    {
        return $this->hasMany(reservation::class);
    }

 


}