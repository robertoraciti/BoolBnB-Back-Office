@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                Correggi i seguenti errori:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('admin.apartments.update', $apartment) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"
                    value="{{ old('name') ?? $apartment->name }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address') ?? $apartment->address }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude"
                    value="{{ old('latitude') ?? $apartment->latitude }}">
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude"
                    value="{{ old('longitude') ?? $apartment->longitude }}">
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="visibility" class="form-label">Visibility</label>
                <select name="visibility" id="visibility" class="form-select @error('visibility') is-invalid @enderror">
                    <option value="0" >Not visible</option>
                    <option value="1">Visible</option>
                
                </select>
                @error('visibility')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" class="form-control @error('rooms') is-invalid @enderror" id="rooms" name="rooms"
                    value="{{ old('rooms') ?? $apartment->rooms }}">
                @error('rooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="number" class="form-control @error('beds') is-invalid @enderror" id="beds" name="beds"
                    value="{{ old('beds') ?? $apartment->beds }}">
                @error('beds')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms" name="bathrooms"
                    value="{{ old('bathrooms') ?? $apartment->bathrooms }}">
                @error('bathrooms')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mq" class="form-label">Mq</label>
                <input type="number" class="form-control @error('mq') is-invalid @enderror" id="mq" name="mq"
                    value="{{ old('mq') ?? $apartment->mq }}">
                @error('mq')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <label class="form-label">Services</label>
            <div class="form-check" @error('services') is-invalid @enderror>
                @foreach ($services as $service)
                    <input class="form-check-control" type="checkbox" value="{{ $service->id }}"
                        id="service-{{ $service->id }}" name="services[]"
                        @if (in_array($service->id, old('services', $service_ids) ?? [])) checked @endif>
                    <label class="form-check-label" for="service-{{ $service->id }}">
                        {{ $service->name }}
                    </label>
                @endforeach
            </div>
            @error('services')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="float" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price') ?? $apartment->price }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-3">
                <label for="cover_image" class="form-label">Immagine</label>
                <input type="url" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{old('cover_image') ?? $apartment->cover_image}}">
                @error('thumb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" name="description">{{ old('description') ?? $apartment->description  }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
    </div>
    @endsection

    {{-- @section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('cover_image');
        const coverImagePreview = document.getElementById('cover_image_preview');


        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            coverImagePreview.src = URL.createObjectURL(file);
        })
    </script>
@endsection --}}