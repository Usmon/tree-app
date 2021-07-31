<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class TreeRequest
 * @package App\Http\Requests\Api
 */
class TreeRequest extends FormRequest
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
        $rules = [
            'tree.create' => [
                'parent_id' => [
                    'required',
                    'integer',
                    Rule::exists('trees')
                ],
                'position' => [
                    'required',
                    'integer',
                    'min:1',
                ],
                'text' => [
                    'required',
                    'string',
                ]
            ],

            'tree.update' => [
                'id' => [
                    'required',
                    'integer',
                    Rule::exists('trees')
                ],
                'text' => [
                    'required',
                    'string',
                ]
            ],

            'tree.delete' => [
                'id' => [
                    'required',
                    'integer',
                    Rule::exists('trees')
                ]
            ],

            'tree.move' => [
                'parent_id' => [
                    'required',
                    'integer',
                    Rule::exists('trees', 'id')
                ],
                'children' => [
                    'required',
                    'array'
                ],
                'children.*' => [
                    'required',
                    'integer',
                    Rule::exists('trees', 'id')
                ]
            ]
        ];

        return $rules[$this->route()->getName()];
    }
}
