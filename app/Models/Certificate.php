<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_number',
        'volunteer_id',
        'project_id',
        'event_id',
        'hours',
        'issue_date',
        'pdf_path',
        'generated_by',
        'status',
        'verification_token',
        'description',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
