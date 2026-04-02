<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoGalleryRequest extends FormRequest
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
   public $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
    public function rules()
    {
        return [
            'title'=>'required|max:254',
            'description'=>'required|max:254',
            'videoUrl'=>'required|url',
        ];
    }
}
