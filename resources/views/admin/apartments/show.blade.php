@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.apartments.index') }}" class="ms-bt me-3"><i class="fa-solid fa-arrow-left me-2"></i>Go
                Back</a>
            <div class="d-flex justify-content-around align-items-center">
                @if (Auth::id() == $apartment->user_id)
                    <a href="{{ route('admin.apartments.edit', $apartment) }}" class="ms-btB">Edit <i
                            class="fa-solid fa-pencil ms-1"></i></a>

                    <a href="{{ route('admin.apartments.messages', ['apartment' => $apartment, 'count' => $count]) }}" class="ms-bt">Messages <span
                            class="badge text-bg-secondary">{{ $count }}</span> <i
                            class="fa-solid fa-envelope ms-1"></i></a>

                    <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal"
                        data-bs-target="#deleteModal-{{ $apartment->id }}">
                        Delete <i class="fa-solid fa-trash text-danger ms-1"></i>
                    </button>

                    <a href="{{ route('admin.apartments.advertise', $apartment) }}" class="btn btn-warning">Promote <i
                            class="fa-star fa-solid"></i></a>
                @endif
            </div>
        </div>
        <h3 class=" my-5 text-center ms-styleB"> {{ $apartment->name }} </h3>
        <div class="row ">
            {{-- ADD COVER_IMAGE --}}
            <div class="col-lg-4 col-sm-12">
                <img src="{{ $apartment->cover_image ? asset('/storage/' . $apartment->cover_image) : 'https://placehold.co/400' }}"
                    class="img-fluid ms-border" id="cover_image_preview">
            </div>
            <div class="col-lg-8 col-sm-12 ms-border">

                <div class="col-sm-12 my-2"> <b>Address:</b> {{ $apartment->address }} </div>
                <div class="col-sm-12 my-2"> <b>Host:</b> {{ $apartment->user->name }} {{ $apartment->user->surname }}
                </div>
                <div class="col-sm-12 my-2 d-none"> <b>Latitude:</b> {{ $apartment->latitude }} </div>
                <div class="col-sm-12 my-2 d-none"> <b>Longitude:</b> {{ $apartment->longitude }} </div>
                <div class="col-sm-12 my-2"> <b>Rooms:</b> {{ $apartment->rooms }} </div>
                <div class="col-sm-12 my-2"> <b>Beds:</b> {{ $apartment->beds }} </div>
                <div class="col-sm-12 my-2"> <b>Bathrooms:</b> {{ $apartment->bathrooms }} </div>
                <div class="col-sm-12 my-2"> <b>Mq:</b> {{ $apartment->mq }} </div>
                <div class="col-sm-12 my-2"> <b>Price:</b> €{{ $apartment->price }} </div>
            </div>

        </div>
        <div class="row mt-5 ms-border">
            <label class="form-label ms-styleB2"><strong>Description:</strong> </label>
            <p> {{ $apartment->description }} </p>
        </div>

        <div class="row mt-2 ms-border">
            <label class="form-label ms-styleB2"><strong>Services:</strong></label>

            @forelse ($apartment->services as $service)
                <div class="col-sm-6 col-md-4">
                    <span> {{ $service->name ?? '' }} </span>
                    <i class="fa-solid fa-{{ $service->icon }} ms-1"></i>

                </div>
            @empty
                <span>No Services Available</span>
            @endforelse
        </div>




        <div class="row my-5 ms-border">

            <label class="ms-styleB2"><strong>Advertisements:</strong></label>
            @forelse ($advertisements as $advertisement)
                <br>
                <p>Your promotion will expire on {{ \Carbon\Carbon::parse($advertisement->expiration_date)->format('d-m-Y') }} </p>


            @empty
                <span>Not promoted</span>
            @endforelse


        </div>
    </div>
@endsection

@section('modal')
    @include('partials.modals.apartments._modalDelete')
@endsection

<style>
    .ms-styleA {
        background-color: #a3c422;

    }

    .ms-styleB {
        background-color: #dcd2c3;
        padding: 10px;
        border-radius: 10px;
        text-decoration: underline;
        text-decoration-color: #a3c422
    }

    .ms-styleB2 {
        background-color: #dcd2c3;
        padding: 10px;
        text-decoration: underline;
        text-decoration-color: #a3c422
    }

    .ms-border {
        border: 2px solid #dcd2c3;
    }

    .ms-bt {
        background-color: #a3c422;
        color: black;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none;
        margin: 0 10px 0px;
        border: 1px solid black
    }

    .ms-btB {
        background-color: #dcd2c3;
        color: black;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none;
        margin: 0 10px 0px;
        border: 1px solid black;
    }

    /* .button {
  background-color: #a3c422;
  border: 1px solid black;
  padding: 5px 35px;
  border-radius: 20px;
  font-weight: 400;
  text-decoration: none;
  color: black;
}

.button:hover {
  background-color: rgba(0, 0, 0, 0.615);
  color: #a3c422;
} */
</style>
