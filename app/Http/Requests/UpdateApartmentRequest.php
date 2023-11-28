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
            'name' => ['required', 'string', 'max:100'],
            'user_id' => ['nullable', 'exists:users,id'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'visibility' => ['required', 'boolean'],
            'rooms' => ['required', 'numeric', 'min:1'],
            'beds' => ['required', 'numeric', 'min:1'],
            'bathrooms' => ['required', 'numeric', 'min:1'],
            'mq' => ['required', 'numeric', 'min:20'],
            'price' => ['required', 'numeric', 'min:10'],
            'cover_image' => ['nullable', 'image'],
            'services' => ['required', 'exists:services,id'],
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
            'rooms.min' => 'The rooms must be at least one',

            'beds.required' => 'The beds is required',
            'beds.numeric' => 'The beds must be a number',
            'beds.min' => 'The beds must be at least one',

            'bathrooms.required' => 'The bathrooms is required',
            'bathrooms.numeric' => 'The bathrooms must be a number',
            'bathrooms.min' => 'The bathrooms must be at least one',

            'mq.required' => 'The mq is required',
            'mq.numeric' => 'The mq must be a number',
            'mq.min' => 'The mq must be at least 20',

            'price.required' => 'The price is required',
            'price.numeric' => 'The price must be a number',
            'price.min' => 'The price is too low',

            // 'cover_image.required' => 'The cover image is required',
            'cover_image.image' => 'The cover image must be a image',

            'user_id.exists' => 'The user ID is not valid',

            'services.required' => 'At least a service is required',
            'services.exists' => 'The selected services are not valid',
        ];
    }
}