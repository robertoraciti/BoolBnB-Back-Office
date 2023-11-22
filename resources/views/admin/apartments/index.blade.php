@extends('layouts.app')

@section('content')
<section class="container mt-5">
    <a class="btn btn-primary" href="{{route('admin.apartments.create')}}">Aggiungi nuovo appartamento</a>
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
                <a href= " {{ route('admin.apartments.show', $apartment )}}"> Dettagli </a>
                <a href= " {{ route('admin.apartments.edit', $apartment )}}"> Modifica </a>
                <a href= "#" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$apartment->id}}"> Elimina </a>
              </td>
            </tr>
              @endforeach
            
          </tbody>
        </table>

        {{ $apartments->links('pagination::bootstrap-5') }}
        
  </section>
@endsection