<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\MaxTotalAmountRule;
class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',

            'description' => 'required|string',

            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id'), // Ensure category exists
            ],

            'targeted_number'=> 'integer',
            'amount'=> [
                'required',
                'integer',
                'min:0',
                new MaxTotalAmountRule($this->targeted_number,$this->category_id,1000), // Apply the custom validation rule
            ],

            
            'user_id' => [
                'integer',
                Rule::exists('users', 'id'), // Validation rule for user_id field
            ],

            'agent_id' => [
                'integer',
                Rule::exists('users', 'id'), // Validation rule for user_id field
            ],

            'customer_id' => [
                'integer',
                Rule::exists('users', 'id'), // Validation rule for user_id field
            ],

            

            // Add other validation rules for additional fields if needed
        ];
         // Add image validation only if a file is present
            if ($this->hasFile('image')) {
                $rules['image'] = 'nullable|image|max:2048';
            }
            

            return $rules;
    }
}