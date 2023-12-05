@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">

    <div class="mt-4">
        <h2>Received messages for {{ $apartment->name }}</h2>
        {{ $messages->links('pagination::bootstrap-5') }}
    </div>

    <div class="mt-4 container card-container">

        @foreach ($messages as $message)
        
        <div class="card">
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