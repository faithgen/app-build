<?php

namespace Faithgen\AppBuild\Http\Requests\Templates;

use FaithGen\SDK\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        return [
            'template_id' => Helper::$idValidation,
            'comment' => 'required'
        ];
    }
}
