<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'people';

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'date_birth',
        'nationality',
    ];

    public function phones() {
        return $this->belongsToMany(Phones::class);
    }
}
