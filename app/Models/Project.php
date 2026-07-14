<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
