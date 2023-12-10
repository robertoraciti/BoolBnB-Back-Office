@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('head-scripts')
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/services/services-web.min.js"></script>


    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.12/SearchBox-web.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('style')
    <style>
        .parsley-errors-list {
            padding: 0;
            margin: 0;
        }

        .parsley-errors-list li {
            color: red;
            list-style: none;

        }
    </style>
@endsection

@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.apartments.index') }}" class="ms-bt me-3"><i class="fa-solid fa-arrow-left me-2"></i>Go
                Back</a>
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

            <form action="{{ route('admin.apartments.store') }}" enctype="multipart/form-data" method="POST"
                id="create-form">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                        name="name" value="{{ old('name') }}" required data-parsley-trigger="keyup">
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
                        <div class="mb-3 d-none">
                            <label for="visibility" class="form-label">Visibility</label>
                            <select name="visibility" id="visibility"
                                class="form-select @error('visibility') is-invalid @enderror">
                                <option value="0" selected>Not visible</option>
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
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                id="latitude" name="latitude" value="{{ old('latitude') }}">
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 d-none">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                id="longitude" name="longitude" value="{{ old('longitude') }}">
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
                                name="rooms" value="{{ old('rooms') }}" required data-parsley-type="number"
                                data-parsley-trigger="keyup" min="1">
                            @error('rooms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="beds" class="form-label">Beds *</label>
                            <input type="number" class="form-control @error('beds') is-invalid @enderror" id="beds"
                                name="beds" value="{{ old('beds') }}" required data-parsley-type="number"
                                data-parsley-trigger="keyup" min="1">
                            @error('beds')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bathrooms" class="form-label">Bathrooms *</label>
                            <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                                id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" required
                                data-parsley-type="number" data-parsley-trigger="keyup" min="1">
                            @error('bathrooms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mq" class="form-label">Mq *</label>
                            <input type="number" class="form-control @error('mq') is-invalid @enderror" id="mq"
                                name="mq" value="{{ old('mq') }}" required data-parsley-type="number"
                                data-parsley-trigger="keyup" min="20">
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
                    <div class="row ">

                        @foreach ($services as $service)
                            <div class="col-sm-6 col-md-4 ">
                                <input class="form-check-control" type="checkbox" value="{{ $service->id }}"
                                    id="service-{{ $service->id }}" required
                                    data-parsley-error-message="Insert at least one service" name="services[]"
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
                    <div class="col-4">
                        <img src="https://placehold.co/400" class="img-fluid" alt="" id="cover_image_preview">

                    </div>
                    <div class="col-8">
                        <label for="cover_image" class="form-label @error('cover_image') is-invalid @enderror">Cover
                            Image *</label>
                        <input type="file" name="cover_image" id="cover_image" value="{{ old('cover_image') }}"
                            class="form-control" required>
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
            ttSearchBox.getSearchBoxHTML().querySelector('input.tt-search-box-input').setAttribute('required', true);
            var searchBoxHTML = ttSearchBox.getSearchBoxHTML()
            let address_search = document.getElementById('address_search')
            address_search.append(searchBoxHTML)

            ttSearchBox.on("tomtom.searchbox.resultselected", function(data) {

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

    <style>
        /* .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            padding: 30px;
        } */

        .ms-bt {
            background-color: #a3c422;
            color: black;
            padding: 10px;
            border-radius: 20px;
            text-decoration: none;
            margin: 0 10px 0px;
            border: 1px solid #a3c422;
        }

        .ms-bt:hover {
            background-color: rgba(0, 0, 0, 0.615);
            color: #a3c422;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .input-group {
            width: 100%;
        }

        .input-group-prepend,
        .input-group-append {
            display: flex;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 5px;
            color: #495057;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .btn-primary {
            background-color: #a3c422;
            border-color: #a3c422;
        }

        .btn-primary:hover {
            background-color: #87a938;
            border-color: #87a938;
        }

        .alert {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .invalid-feedback {
            color: #dc3545;
        }
    </style>
    <style>
        .tt-search-box {
            margin-top: 12px;
            font-size: 14px;
            font-family: Helvetica, Arial, sans-serif !important;
            position: relative
        }

        .tt-searchbox-filter-label {
            font-size: 14px;
            background-color: #edf2f7;
            padding: 2px 0 2px 4px;
            border-radius: 2px;
            color: #000;
            font-weight: 700;
            white-space: nowrap;
            border: 1px solid transparent;
            align-items: center;
            min-width: 0;
            overflow: hidden;
            max-width: 100px;
            box-sizing: border-box;
            flex-shrink: 0;
        }

        .tt-searchbox-filter-label.-hidden {
            display: none
        }

        .tt-searchbox-filter-label__text {
            text-overflow: ellipsis;
            overflow: hidden
        }

        .tt-searchbox-filter-label__close-button {
            cursor: pointer;
            padding: 0 4px;
        }

        .tt-searchbox-filter-label__close-button svg {
            fill: #ccc;
            width: 10px;
            height: 10px
        }

        .tt-searchbox-filter-label__close-button:hover svg {
            fill: #7a7e80
        }

        .tt-searchbox-filter-label.-highlighted .tt-searchbox-filter-label__close-button svg {
            fill: #7a7e80
        }

        .tt-search-box-input-container {
            background: #fff;
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            padding: 6px;
            display: flex;
            align-items: center;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .tt-search-box-input-container.-focused {
            box-shadow: 0 2px 9px -1px rgba(0, 0, 0, .19);
            border-color: transparent
        }

        .mapboxgl-control-container .tt-search-box-input-container {
            box-shadow: 0 2px 9px -1px rgba(0, 0, 0, .19);
        }

        .mapboxgl-control-container .tt-search-box-input-container.-focused {
            border-color: #ccc
        }

        .mapboxgl-control-container .tt-search-box-input-container:hover {
            border-color: #ccc
        }

        .tt-search-box-input {
            position: relative;
            vertical-align: text-bottom;
            border: none;
            outline: none;
            box-shadow: none;
            padding-left: 4px;
            background-position: 0;
            background-color: transparent;
            width: calc(100% - 50px);
            font-size: 14px;
            min-width: 0
        }

        .tt-search-box-input::-ms-clear {
            display: none
        }

        .tt-search-box-result-list-container {
            max-height: 375px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            position: absolute;
            z-index: 10;
            width: 100%;
            box-shadow: 0 2px 9px -1px rgba(0, 0, 0, .19);
            background-color: #fff;
            padding: 3px 0
        }

        .tt-search-box-result-list {
            background-color: #fff;
            cursor: pointer;
            height: auto;
            padding: 4px 6px;
            color: #7a7e80;
            display: flex;
            align-items: baseline;
        }

        .tt-search-box-result-list>svg {
            flex-shrink: 0;
            fill: #7a7e80;
            margin-right: 4px;
            align-self: center;
        }

        .tt-search-box-result-list:first-child {
            display: none;
        }

        .tt-search-box-result-list.suggestion {
            margin-bottom: 10px;
            position: relative;
            display: none;
        }

        .tt-search-box-result-list.suggestion:after {
            content: "";
            position: absolute;
            bottom: -9px;
            left: 50%;
            transform: translateX(-50%);
            height: 1px;
            width: calc(100% - 32px);
            background: rgba(0, 0, 0, .08);
            display: none;
        }

        .tt-search-box-result-category-icon {
            background-size: 24px;
            background-position: 50%;
            float: left;
            padding: 12px;
            margin: 5px 12px 0 4px;
            display: none;
        }

        .tt-search-box-result-suggestion-icon {
            background-size: 22px;
            background-position: 50%;
            border-radius: 50%;
            float: left;
            margin: 5px 9px 0 0;
            padding: 15px;
            display: none;
        }

        .tt-search-box-result-suggestion-icon.-brand {
            background-size: 16px
        }

        .tt-search-box-result-list-suggestion-arrow {
            float: right;
            margin-top: 8px;
            display: none;
        }

        .tt-search-box-result-list-text-suggestion {
            align-self: center;
            width: 100%;
            display: none;
        }

        .tt-search-box-result-list-text-content,
        .tt-search-box-result-list-text-suggestion {
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .tt-search-box-result-list-distance {
            font-size: 10px;
            margin-left: auto;
            padding-left: 8px;
            white-space: nowrap;
            word-break: keep-all
        }

        .tt-search-box-result-list.-highlighted {
            background-color: #edf2f7 !important;
            height: auto
        }

        .tt-search-box-result-list-address {
            overflow: hidden;
            width: 100%;
        }

        .tt-search-box-result-list-address>* {
            display: block
        }

        .tt-search-box-result-list-bold+.tt-search-box-result-list-text-content {
            margin-top: 4px
        }

        .tt-search-box-result-list-bold {
            color: #000;
            font-size: 14px;
            font-weight: 700;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .tt-search-box-close-icon {
            cursor: pointer;
            margin-left: auto;
            fill: #ccc;
            transition: fill .2s ease;
        }

        .tt-search-box-close-icon:hover {
            fill: #7a7e80
        }

        .tt-search-box-close-icon.-hidden {
            visibility: hidden
        }
    </style>
