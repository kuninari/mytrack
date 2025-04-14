<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    //
    protected $fillable = ['title', 'user_id'];

    public function habits()
    {
        return $this->hasMany(Habit::class);
    }

    public function records()
    {
        return $this->hasMany(HabitRecord::class);
    }
}
