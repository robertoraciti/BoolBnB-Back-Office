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

                        <a href="{{ route('admin.apartments.messages', $apartment) }}" class="btn btn-primary">Messages <span class="badge text-bg-secondary">{{ $count }}</span> <i
                            class="fa-solid fa-envelope ms-1"></i></a>
                        
                    <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $apartment->id }}">
                    Delete <i class="fa-solid fa-trash text-danger ms-1"></i>
                    </button>

                    <a href="{{ route('admin.apartments.advertise', $apartment) }}" class="btn btn-dark">Promote</a>
                    @endif
                </div>
        </div>
        <h3 class="text-info my-5 text-center"> {{ $apartment->name }} </h3>
        <div class="row ">
            {{-- ADD COVER_IMAGE --}}
            <div class="col-lg-4 col-sm-12">
                <img src="{{ $apartment->cover_image ? asset('/storage/'. $apartment->cover_image) : "https://placehold.co/400" }}" class="img-fluid" id="cover_image_preview">
            </div>
            <div class="col-lg-8 col-sm-12">

                <div class="col-sm-12 my-2"> <b>Address:</b> {{ $apartment->address }} </div>
                <div class="col-sm-12 my-2"> <b>Host:</b> {{ $apartment->user->name }} {{ $apartment->user->surname }} </div>
                <div class="col-sm-12 my-2 d-none"> <b>Latitude:</b> {{ $apartment->latitude }} </div>
                <div class="col-sm-12 my-2 d-none"> <b>Longitude:</b> {{ $apartment->longitude }} </div>
                <div class="col-sm-12 my-2"> <b>Rooms:</b> {{ $apartment->rooms }} </div>
                <div class="col-sm-12 my-2"> <b>Beds:</b> {{ $apartment->beds }} </div>
                <div class="col-sm-12 my-2"> <b>Bathrooms:</b> {{ $apartment->bathrooms }} </div>
                <div class="col-sm-12 my-2"> <b>Mq:</b> {{ $apartment->mq }} </div>
                <div class="col-sm-12 my-2"> <b>Price:</b> €{{ $apartment->price }} </div>
                <div class="col-sm-12 my-2"> <b>Visibility:</b> {{ $apartment->visibility }} </div>
            </div>
            <div class="col-12 g-3"><b>Description:</b> <p> {{ $apartment->description }} </p></div>

        </div>

        <div class="row ">
            <label class="form-label g-3">Services:</label>

            @forelse ($apartment->services as $service)
            <div class="col-sm-6 col-md-4">
                <span> {{ $service->name ?? '' }} </span>
                <i class="fa-solid fa-{{ $service->icon }} ms-1"></i>

            </div>
            @empty
                <span>No Services Available</span>    
            @endforelse
        </div>




        <div class="row">
            <div class="col-6">
                <p>
                    <strong>Advertisements:</strong>
                    @forelse ($apartment->advertisements as $advertisement)
                        <br>
                        <p>Active promotion: {{ $advertisement->label ?? '' }} </p>
                        <p>Your promotion will expire on {{$advertisement->pivot->expiration_date}}</p>


                    @empty
                        <span>Not promoted</span>
                    @endforelse
                </p>

            </div>
        </div>

    @endsection

    @section('modal')
        @include('partials.modals.apartments._modalDelete')
    @endsection
