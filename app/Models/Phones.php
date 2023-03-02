<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    use HasFactory;
    protected $table = 'phones';

    protected $fillable = [
        'phone',
        'people_id',
    ];

    public function people() {
        return $this->hasOne(People::class);
    }
}
