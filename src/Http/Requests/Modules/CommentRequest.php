<?php

namespace Faithgen\AppBuild\Http\Requests\Modules;

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
            'module_id' => Helper::$idValidation,
            'comment' => 'required',
        ];
    }
}
