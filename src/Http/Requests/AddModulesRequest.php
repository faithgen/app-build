<?php

namespace Faithgen\AppBuild\Http\Requests;

use FaithGen\SDK\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class AddModulesRequest extends FormRequest
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
            'modules' => 'required|array',
            'modules.*' => 'required|'.Helper::$idValidation,
        ];
    }
}
