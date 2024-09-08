<?php

namespace App\Rules;

use App\Models\Criteria;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TotalWeight implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currentWeight = Criteria::all()->sum('weight');
        $totalCurrentWeight = $currentWeight + (int) $value;

        if ($totalCurrentWeight > 100) {
            $fail("Total keseluruhan bobot tidak boleh lebih dari 100. Bobot sekarang $currentWeight");
        }
    }
}
