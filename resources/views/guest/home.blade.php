@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row g-5">
    

    @foreach ($apartments as $apartment)
     @if (Auth::id() == $apartment->user_id)
     <div class="col-3">

       <div class="card" style="width: 18rem;">
         <img src="{{ $apartment->cover_image}}" class="card-img-top img-fluid" alt="...">
         <div class="card-body">
           <h5 class="card-title">{{ $apartment->name }}</h5>
           <p class="card-text">{{ $apartment->description }}</p>
         </div>
         <ul class="list-group list-group-flush">
           <li class="list-group-item">Rooms: {{ $apartment->rooms }}</li>
           <li class="list-group-item">Beds: {{ $apartment->beds }}</li>
           <li class="list-group-item">Bathrooms: {{ $apartment->bathrooms }}</li>
           <li class="list-group-item">Mq: {{ $apartment->mq }}</li>
         </ul>
         <div class="card-body">
           <a href= " {{ route('admin.apartments.show', $apartment) }}" class="btn btn-primary">Show details</a>
         </div>
       </div>
     </div>
     @endif
     @endforeach
   </div>
  </div>

@endsection
