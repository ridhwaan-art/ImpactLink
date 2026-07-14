<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'project_id',
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'maximum_volunteers',
        'qr_token',
        'status',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'volunteer_event')->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
