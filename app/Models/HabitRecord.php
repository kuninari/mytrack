<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitRecord extends Model
{
    //
    protected $fillable = ['recorded_date', 'is_done'];

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }
}
