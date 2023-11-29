@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('head-scripts')
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/services/services-web.min.js"></script>


    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.12/SearchBox-web.js"></script>
    <link
    rel="stylesheet"
    type="text/css"
    href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.12/SearchBox.css"
    />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('style')
    <style>

        .parsley-errors-list {
            padding: 0;
            margin: 0;
        }
        .parsley-errors-list li{
            color: red;
            list-style:none ;

        }
    </style>

@endsection

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary me-3"><i
            class="fa-solid fa-arrow-left me-2"></i>Go Back</a>
    </div>
    <div class="container my-5">

        @if ($errors->any())
            <div class="alert alert-danger">
                Fix the following errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.apartments.store') }}" enctype="multipart/form-data" method="POST" id="create-form">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                    name="name" value="{{ old('name') }}" required data-parsley-pattern="[a-zA-Z]+$" data-parsley-trigger="keyup">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address *</label>
                <input type="hidden" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div id="address_search"></div>
            </div>

            {{-- @include('partials._searchbox') --}}
            {{-- PRICE--LOCATION--VISIBILITY --}}

            <div class="container">
                <div class="row row-cols-2">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price') }}" required data-parsley-trigger="keyup">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="visibility" class="form-label">Visibility</label>
                        <select name="visibility" id="visibility"
                            class="form-select @error('visibility') is-invalid @enderror">
                            <option value="0">Not visible</option>
                            <option value="1">Visible</option>

                        </select>
                        @error('visibility')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 d-none">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                            name="latitude" value="{{ old('latitude') }}">
                        @error('latitude')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 d-none">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                            name="longitude" value="{{ old('longitude') }}">
                        @error('longitude')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- DETAILS ROW --}}
            <div class="container">
                <div class="row row-cols-4">

                    <div class="mb-3">
                        <label for="rooms" class="form-label">Rooms *</label>
                        <input type="number" class="form-control @error('rooms') is-invalid @enderror" id="rooms"
                            name="rooms" value="{{ old('rooms') }}" required data-parsley-type="number" data-parsley-trigger="keyup" min="1">
                        @error('rooms')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="beds" class="form-label">Beds *</label>
                        <input type="number" class="form-control @error('beds') is-invalid @enderror" id="beds"
                            name="beds" value="{{ old('beds') }}" required data-parsley-type="number" data-parsley-trigger="keyup" min="1">
                        @error('beds')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms *</label>
                        <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
                            name="bathrooms" value="{{ old('bathrooms') }}" required data-parsley-type="number" data-parsley-trigger="keyup" min="1">
                        @error('bathrooms')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mq" class="form-label">Mq *</label>
                        <input type="number" class="form-control @error('mq') is-invalid @enderror" id="mq"
                            name="mq" value="{{ old('mq') }}" required data-parsley-type="number" data-parsley-trigger="keyup" min="20">
                        @error('mq')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- SERVICES ROW --}}

            <label class="form-label">Services *</label>
            <div class="form-check container  @error('services') is-invalid invalid-input p-2 @enderror">
                <div class="row row-cols-4">

                    @foreach ($services as $service)
                        <div class="col">
                            <input class="form-check-control" type="checkbox" value="{{ $service->id }}"
                                id="service-{{ $service->id }}" required data-parsley-error-message="Insert at least one service" name="services[]"
                                @if (in_array($service->id, old('services') ?? [])) checked @endif>
                            <label class="form-check-label" for="service-{{ $service->id }}">
                                {{ $service->name }} <i class="fa-solid fa-{{ $service->icon }} mx-1"></i>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('services')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            {{-- IMG AND DESCRIPTION --}}

            <div class="row mt-5 mb-3">
                <div class="col-4" >
                    <img src="https://placehold.co/400" class="img-fluid" alt="" id="cover_image_preview">
                    
                </div>
                <div class="col-8">
                    <label for="cover_image" class="form-label @error('cover_image') is-invalid @enderror">Cover Image *</label>
                    <input type="file" name="cover_image" id="cover_image" value="{{ old('cover_image') }}" class="form-control" required>
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description *</label>
                <textarea class="form-control" name="description" id="description" required name="description">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i>Add</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

    var options = {
        searchOptions: {
          key: "k9U6D8g43D9rsDAaXC4vgkIc4Ko56P7d",
          language: "it-IT",
          limit: 5,
        },
        autocompleteOptions: {
          key: "k9U6D8g43D9rsDAaXC4vgkIc4Ko56P7d",
          language: "it-IT",
        },
      }
      var ttSearchBox = new tt.plugins.SearchBox(tt.services, options)
      var searchBoxHTML = ttSearchBox.getSearchBoxHTML()
      let address_search = document.getElementById('address_search')
      address_search.append(searchBoxHTML)

      ttSearchBox.on("tomtom.searchbox.resultselected", function (data) {

        console.log(data.data.result.address.freeformAddress)

        let address = document.getElementById('address');
        let lng = document.getElementById('longitude');
        let lat = document.getElementById('latitude');

        let addressVal = data.data.result.address.freeformAddress
        let lngVal = data.data.result.position.lng;
        let latVal = data.data.result.position.lat;

        address.value = addressVal;
        lng.value = lngVal;
        lat.value = latVal;

})

    const inputFileElement = document.getElementById('cover_image');
    const coverImagePreview = document.getElementById('cover_image_preview');

    inputFileElement.addEventListener('change', function() {
        const [file] = this.files;
        coverImagePreview.src = URL.createObjectURL(file);
    })
        
    </script>
    <script type="text/javascript">
        $('#create-form').parsley();
    </script>
@endsection
