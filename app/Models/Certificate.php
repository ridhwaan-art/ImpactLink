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
        'issue_date',
        'pdf_path',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
