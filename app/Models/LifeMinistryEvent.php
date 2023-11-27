<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LifeMinistryEvent extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'life_ministry_events';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'life_ministry_id',
        'assignment_id',
        'student_id',
        'position',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function life_ministry()
    {
        return $this->belongsTo(LifeMinistry::class, 'life_ministry_id');
    }
    
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
