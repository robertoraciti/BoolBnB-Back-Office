@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary me-3"><i
                class="fa-solid fa-arrow-left me-2"></i>Go Back</a>
                <div>
                    @if (Auth::id() == $apartment->user_id)
                        
                    <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-warning">Edit <i
                        class="fa-solid fa-pencil ms-1"></i></a>
                        
                    <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $apartment->id }}">
                    Delete <i class="fa-solid fa-trash text-danger ms-1"></i>
                    </button>

                    <a href="{{ route('admin.apartments.advertise', $apartment) }}" class="btn btn-dark">Promote</a>
                    @endif
                </div>
        </div>
        <h3 class="text-info my-5 text-center"> {{ $apartment->name }} </h3>
        <div class="row">
            {{-- ADD COVER_IMAGE --}}
            <div class="col-4">
                <img src="{{ $apartment->cover_image ? asset('/storage/'. $apartment->cover_image) : "https://placehold.co/400" }}" class="img-fluid" id="cover_image_preview">
            </div>
            <div class="col-8 row">

                <div class="col-6"> <b>Address:</b> {{ $apartment->address }} </div>
                <div class="col-6"> <b>Host:</b> {{ $apartment->user->name }} {{ $apartment->user->surname }} </div>
                <div class="col-6"> <b>Latitude:</b> {{ $apartment->latitude }} </div>
                <div class="col-6"> <b>Longitude:</b> {{ $apartment->longitude }} </div>
                <div class="col-6"> <b>Rooms:</b> {{ $apartment->rooms }} </div>
                <div class="col-6"> <b>Beds:</b> {{ $apartment->beds }} </div>
                <div class="col-6"> <b>Bathrooms:</b> {{ $apartment->bathrooms }} </div>
                <div class="col-6"> <b>Mq:</b> {{ $apartment->mq }} </div>
                <div class="col-6"> <b>Price:</b> €{{ $apartment->price }} </div>
                <div class="col-6"> <b>Visibility:</b> {{ $apartment->visibility }} </div>
                <div class="col-12"> <b>Description:</b> <br> {{ $apartment->description }} </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <p>
                    <strong>Services:</strong>
                    @forelse ($apartment->services as $service)
                        <br>
                        <span> {{ $service->name ?? '' }} </span>
                        <i class="fa-solid fa-{{ $service->icon }} ms-1"></i>


                    @empty
                        <span>No Services Available</span>
                    @endforelse
                </p>

            </div>
        </div>
    @endsection

    @section('modal')
        @include('partials.modals.apartments._modalDelete')
    @endsection
