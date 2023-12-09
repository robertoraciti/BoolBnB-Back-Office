@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="mt-3"><a href= " {{ route('admin.apartments.show', $apartment) }}" class="ms-bt"><i
                    class="fa-solid fa-arrow-left me-2"></i>Go Back</a></div>

        <div class="mt-4">
            <h2 class="ms-style ms-rounded text-center"> You have a total of <span>{{ $count }}</span> received
                messages for {{ $apartment->name }}</h2>
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>

        <div class="mt-4 container card-container">

            @foreach ($messages as $message)
                <div class="card my-3">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">User: {{ $message->name }}</h5>
                        <h5 class="card-title">Email: {{ $message->email }}</h5>
                        <h5 class="card-title">Sent: {{ $message->created_at }}</h5>
                        <h5 class="card-title">Message: </h5>
                        <p class="card-text">{{ $message->text }}</p>

                    </div>
                </div>
            @endforeach
        </div>
        {{ $messages->links('pagination::bootstrap-5') }}


    </div>
@endsection


<style>
    .ms-style {
        background-color: #a3c422;
    }

    .ms-rounded {
        border-radius: 15px
    }

    .ms-styleB {
        color: #dcd2c3;
    }

    .card {
        background-color: #dcd2c3 !important;
        border: 2px solid #a3c422 !important;
    }

    .card:hover {
        transform: translate3D(0, -1px, 0) scale(1.03);
        box-shadow: 8px 14px 38px rgba(39, 44, 49, .06), 1px 3px 8px rgba(39, 44, 49, .03);
        transition: all .5s ease;
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
</style>
