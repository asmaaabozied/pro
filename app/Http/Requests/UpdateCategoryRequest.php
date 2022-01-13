<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class UpdateCategoryRequest extends FormRequest
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
        $rules = Category::$rules;
        $rules['title_ar']='required|unique:categories,title_ar,'.$this->request->get('id');
        $rules['title_en']='required|unique:categories,title_en,'.$this->request->get('id');
        return $rules;
    }
}
