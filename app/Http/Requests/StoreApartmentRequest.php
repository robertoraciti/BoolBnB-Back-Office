<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'visibility' => ['required','boolean'],
            'rooms' => ['required','numeric'],
            'beds' => ['required','numeric'],
            'bathrooms' => ['required','numeric'],
            'mq' => ['required','numeric'],
            'price' => ['required','numeric'],
            'cover_image' => ['required', 'url'],
            'services' => ['nullable','exists:services,id'],
            'user_id' => ['nullable','exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must have a maximum of 100 characters',

            'description.required' => 'The description is required',
            'description.string' => 'The description must be a string',

            'address.required' => 'The address is required',
            'address.string' => 'The address must be a string',

            'latitude.required' => 'The latitude is required',
            'latitude.string' => 'The latitude must be a string',

            'longitude.required' => 'The longitude is required',
            'longitude.string' => 'The longitude must be a string',

            'visibility.required' => 'The visibility is required',
            'visibility.boolean' => 'The visibility must be a boolean value',

            'rooms.required' => 'The rooms is required',
            'rooms.numeric' => 'The rooms must be a number',

            'beds.required' => 'The beds is required',
            'beds.numeric' => 'The beds must be a number',

            'bathrooms.required' => 'The bathrooms is required',
            'bathrooms.numeric' => 'The bathrooms must be a number',

            'mq.required' => 'The mq is required',
            'mq.numeric' => 'The mq must be a number',

            'price.required' => 'The price is required',
            'price.numeric' => 'The price must be a number',

            'cover_image.required' => 'The cover image is required',
            'cover_image.url' => 'The cover image must be a url',

            'user_id.exists' => 'The user ID is not valid',

            'services.exists' => 'The selected services are not valid',
        ];
    }
}