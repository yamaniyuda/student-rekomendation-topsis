<?php

namespace App\Models;

use App\Observers\StudentObserve;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


#[ObservedBy([StudentObserve::class])]
class Student extends Model
{
    use HasFactory;
    use HasUuids;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gender',
        'photo_profile',
        'id',
        'address',
        'status',
        'user_id',
    ];


    /**
     * Get the student score that owns the 
     */
    public function studentScore(): HasMany
    {
        return $this->hasMany(StudentScore::class, 'student_id');
    }


    public function getCriteria($year)
    {
        $criterias = Criteria::all();
        $student = $this->with([
                'user',
                'studentScore' => function ($q) use ($year) {
                    $q->where('year', $year);
                },
                'studentScore.criteriaDetails',
                'studentScore.criteriaDetails.criteria'
            ])->find($this->id);

        $criteriaIds = $criterias->reduce(function ($carry, $item) {
            $wraping = [
                $item->symbol => 0,
            ];

            return $carry->merge($wraping);
        }, collect([]));

        $studentScoresNew = $student->studentScore->map(function ($item) use ($criteriaIds) {
            $new = $criteriaIds;
            $item->criteriaDetails->map(function ($item) use ($new) {
                $new[$item->criteria->symbol] = [
                    'name' => $item->criteria->name,
                    'classification' => $item->classification,
                    'weight' => $item->weight
                ];
            });

            return $new;
        });

        return $studentScoresNew[0]->merge(['name' => $student->user->name]);
    }


    /**
     * Get the post that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // public function getCrietria


    public function getCrietriaTable()
    {
        $criterias = Criteria::all();
        $student = $this->with('studentScore', 'studentScore.criteriaDetails')->find($this->id);

        $criteriaIds = $criterias->reduce(function ($carry, $item) {
            $wraping = [
                'symbol' => $item->symbol ?? '',
                'criteria_weight' => $item->criteria_weight ?? '',
                'preference_weight' => optional($item->preference_weight) ?? ''
            ];

            return $carry->merge([
                $item->id => $wraping
            ]);
        }, collect([]));

        
        if ($student->studentScore->count() === 0) {
            return [
                [
                    ...$criteriaIds,
                    'year' => '0000',
                    'id' => null
                ]
            ];
        }


        $studentScoresNew = $student->studentScore->map(function ($item) use ($criteriaIds) {
            $new = $criteriaIds;
            $item->criteriaDetails->map(function ($item) use ($new) {
                $new[$item->criteria_id] = [
                    ...$new[$item->criteria_id],
                    'id_detail_criteria' => $item->id,
                    'classification' => $item->classification,
                    'weight' => $item->weight
                ];
            });

            return $new->merge(['year' => $item->year, 'id' => $item->id]);
        });

        return $studentScoresNew;
    }
}
