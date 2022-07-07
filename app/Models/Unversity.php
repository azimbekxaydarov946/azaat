<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unversity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function fakulty()
    {
        return $this->hasMany(Fakulty::class);
    }
}
