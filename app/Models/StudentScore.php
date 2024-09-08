<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StudentScore extends Model
{
    use HasFactory;
    use HasUuids;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'year'
    ];


    /**
     * The criteria detail that belong to the student score.
     */
    public function criteriaDetails(): BelongsToMany
    {
        return $this->belongsToMany(CriteriaDetail::class, 'score_criteria_students');
    }
}
