<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'number',
        'overseer_id',
        'helper_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function groupPublishers()
    {
        return $this->hasMany(Publisher::class, 'group_id', 'id');
    }

    public function overseer()
    {
        return $this->belongsTo(Publisher::class, 'overseer_id');
    }

    public function helper()
    {
        return $this->belongsTo(Publisher::class, 'helper_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
