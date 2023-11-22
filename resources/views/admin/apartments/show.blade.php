@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.apartments.index')}}" class="btn btn-primary">Go Back</a>
        <a href="{{ route('admin.apartments.edit', $apartment)}}" class="btn btn-warning">Edit</a>
        <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$apartment->id}}">
            Delete
          </button>
    </div>
    <h3 class="text-danger mt-5"> {{ $apartment->name }} </h3>
    <div class="row">
        {{-- ADD COVER_IMAGE --}}
        <div class="col-4">
            <img src="{{$apartment->cover_image}}" class="img-fluid">
        </div>
        <div class="col-8 row">

            <div class="col-6"> <b>Address:</b> {{ $apartment->address}} </div>
            <div class="col-6">  <b>Latitude:</b> {{ $apartment->latitude }} </div>
            <div class="col-6">  <b>Longitude:</b> {{ $apartment->longitude }} </div>
            <div class="col-6">  <b>Rooms:</b> {{ $apartment->rooms }} </div> 
            <div class="col-6">  <b>Beds:</b> {{ $apartment->beds }} </div>
            <div class="col-6">  <b>Bathrooms:</b> {{ $apartment->bathrooms }} </div> 
            <div class="col-6">  <b>Mq:</b> {{ $apartment->mq }} </div> 
            <div class="col-6">  <b>Price:</b> €{{ $apartment->price }} </div>  
            <div class="col-6">  <b>Visibility:</b> {{ $apartment->visibility }} </div>  
            <div class="col-12">  <b>Description:</b> <br> {{ $apartment->description }} </div> 
        </div>
        
    </div>
@endsection

@section('modal')
    @include('partials.modals.apartments._modalDelete')
@endsection