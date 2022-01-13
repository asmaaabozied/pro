<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CategoryAttribute;

class CreateCategoryAttributeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = CategoryAttribute::$rules;
        $rules['name_ar']='required|unique:category_attributes,name_ar,id';
        $rules['name_en']='required|unique:category_attributes,name_en,id';
        return $rules;
    }
}
