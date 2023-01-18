<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class Publisher extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Auditable;

    public $table = 'publishers';

    protected $dates = [
        'baptism',
        'birth',
        'dav_expiration',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'full_name',
        'address',
        'phone',
        'emergency',
        'celphone',
        'baptism',
        'birth',
        'email',
        'rgpd',
        'dav',
        'dav_expiration',
        'group_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function overseerGroups()
    {
        return $this->hasMany(Group::class, 'overseer_id', 'id');
    }

    public function helperGroups()
    {
        return $this->hasMany(Group::class, 'helper_id', 'id');
    }

    public function getBaptismAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBaptismAttribute($value)
    {
        $this->attributes['baptism'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthAttribute($value)
    {
        $this->attributes['birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function responsibilities()
    {
        return $this->belongsToMany(Responsibility::class);
    }

    public function getDavExpirationAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDavExpirationAttribute($value)
    {
        $this->attributes['dav_expiration'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
