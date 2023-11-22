@extends('layouts.app')

@section('content')
<section class="container mt-5">
    <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Add new apartment</a>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Rooms</th>
              <th scope="col">Beds</th>
              <th scope="col">Bathrooms</th>
              <th scope="col">Mq</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($apartments as $apartment)
                  <tr>
              <td>{{$apartment->id}}</td>
              <td>{{$apartment->name}}</td>
              <td>{{$apartment->address}}</td>
              <td>{{$apartment->rooms}}</td>
              <td>{{$apartment->beds}}</td>
              <td>{{$apartment->bathrooms}}</td>
              <td>{{$apartment->mq}}</td>
              <td>{{$apartment->price}}</td>
              <td>
                <a href= " {{ route('admin.apartments.show', $apartment )}}"> Details </a>
                <a href= " {{ route('admin.apartments.edit', $apartment )}}"> Edit </a>
                <a href= "#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$apartment->id}}"> Delete </a>
              </td>
            </tr>
              @endforeach
            
          </tbody>
        </table>

        {{ $apartments->links('pagination::bootstrap-5') }}
        
  </section>
@endsection

@section('modal')
  @foreach ($apartments as $apartment)
    @include('partials.modals.apartments._modalDelete')
      
  @endforeach
@endsection