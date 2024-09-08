<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CriteriaDetail extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'classification',
        'weight',
        'criteria_id'
    ];
    

    /**
     * Get the criteria for criteria detail.
     */
    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }


    public function studentScores(): BelongsToMany
    {
        return $this->belongsToMany(StudentScore::class, 'score_criteria_students')->withPivot('pivot_column');
    }
}
