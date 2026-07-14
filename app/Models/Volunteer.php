<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'gender',
        'age_range',
        'phone',
        'email',
        'location',
        'volunteer_type',
        'institution_name',
        'status',
        'qr_code',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'volunteer_event')->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
