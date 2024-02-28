<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Product;
class MaxTotalAmountRule implements Rule

{
    protected $targetedNumber;
    protected $categoryId;
    protected $limit;

    public function __construct($targetedNumber, $categoryId, $limit)
    {
        $this->targetedNumber = $targetedNumber;
        $this->categoryId = $categoryId;
        $this->limit = $limit;
    }

    public function passes($attribute, $value)
    {
        // Calculate the sum of the total amount for the given targeted_number and category
        $totalAmount = Product::where('targeted_number', $this->targetedNumber)
                              ->where('category_id', $this->categoryId)
                              ->sum('amount');

        // Check if adding the current value exceeds the limit
        return $totalAmount + $value <= $this->limit;
    }

    public function message()
    {
        return 'The total amount for the same targeted number and category exceeds the limit.';
    }
}

