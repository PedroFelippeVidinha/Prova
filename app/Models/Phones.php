<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    use HasFactory;
    protected $table = 'phone';

    protected $fillable = [
        'phone',
        'people_id',
    ];

    public function peoples() {
        return $this->belongsToMany(People::class);
    }
}
