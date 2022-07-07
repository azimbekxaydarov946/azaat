<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakulty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'university_id',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }
}
