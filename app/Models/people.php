<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class People extends Model
{
    use HasFactory;


    protected $table = 'peoples';

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'date_birth',
        'nationality',
    ];

    public function phones() {
        return $this->hasMany(Phones::class);
    }
}
