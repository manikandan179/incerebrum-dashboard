<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class CandidateModel extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $table = 'candidate';
    protected $casts = [
        'dob' => 'date',
        'preferred_start_date' => 'date',
    ];
    
    protected $fillable = [
        'user_id',
        'dob',
        'nationality',
        'address',
        'highest_qualification',
        'institution_name',
        'course_name',
        'year_of_completion',
        'certificates',
        'preferred_start_date',
        'specializations',
        'work_experience',
        'reason_for_joining',
        'special_fequirements',
    ];
    

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
