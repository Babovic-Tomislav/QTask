<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    protected $casts = [
        'number_of_pages' => 'integer',
    ];

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'release_date' => 'required|date_format:Y-m-d',
            'description' => 'required',
            'isbn' => 'required',
            'format' => 'required',
            'number_of_pages' => 'required|integer',
            'author' => 'required',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data =  parent::validated($key, $default);

        if (array_key_exists('author', $data)) {
            if (!is_array($data['author'])) {
                $authorId = $data['author'];
                unset($data['author']);

                $data['author']['id'] = $authorId;
            }
        }

        $data['number_of_pages'] = intval($data['number_of_pages']);

        return $data;
    }
}
