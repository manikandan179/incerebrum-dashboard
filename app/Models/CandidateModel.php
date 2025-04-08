<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class CandidateModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $dates = ['dateOfBirth', 'preferredStartDate', 'deletedAt'];

    protected $fillable = [
        'userId',
        'dateOfBirth',
        'nationality',
        'address',
        'highestQualification',
        'institutionName',
        'courseName',
        'yearOfCompletion',
        'certificates',
        'preferredStartDate',
        'specializations',
        'workExperience',
        'reasonForJoining',
        'specialRequirements',
    ];

    protected $casts = [
        'dateOfBirth' => 'datetime',
        'preferredStartDate' => 'datetime',
        'yearOfCompletion' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
