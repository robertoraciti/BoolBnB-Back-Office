<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'user_id' => ['nullable', 'exists:users,id'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'visibility' => ['required', 'boolean'],
            'rooms' => ['required', 'numeric'],
            'beds' => ['required', 'numeric'],
            'bathrooms' => ['required', 'numeric'],
            'mq' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'cover_image' => ['required', 'url'],
            'services' => ['nullable', 'exists:services,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be contains 100 characters',

            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',

            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',

            'user.exists' => 'Invalid user',

            'latitude.required' => 'Latitude is required',
            'latitude.string' => 'Latitude must be a string',

            'longitude.required' => 'Longitude is required',
            'longitude.string' => 'Longitude must be a string',

            'visibility.required' => 'Visibility is required',
            'visibility.boolean' => 'Visibility must be a boolean',

            'rooms.required' => 'Rooms is required',
            'rooms.numeric' => 'Rooms must be a number',

            'beds.required' => 'Beds is required',
            'beds.numeric' => 'Beds must be a number',

            'bathrooms.required' => 'Bathrooms is required',
            'bathrooms.numeric' => 'Bathrooms must be a number',

            'mq.required' => 'Mq is required',
            'mq.numeric' => 'Mq must be a number',

            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',

            'cover_image.required' => 'Cover_image is required',
            'cover_image.url' => 'Cover_image must be an URL',

            'services.exists' => 'Invalid services',
        ];
    }
}