@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')
    <section class="container mt-5">
        <a class="btn btn-primary" href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-plus me-2"></i>Add new
            apartment </a>
            <div class="my-5 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col" class="text-center d-none d-md-table-cell d-flex align-items-center">Rooms</th>
                            <th scope="col" class="text-center d-none d-md-table-cell">Beds</th>
                            <th scope="col" class="text-center d-none d-md-table-cell">Bathrooms</th>
                            <th scope="col" class="text-center d-none d-md-table-cell">Mq</th>
                            <th scope="col" class="text-center d-none d-md-table-cell">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                        @if (Auth::id() == $apartment->user_id)
                        <tr>
                            <td>{{ $apartment->id }}</td>
                            <td>{{ $apartment->name }}</td>
                            <td>{!! $apartment->getAddress() !!}</td>
                            <td class="text-center d-none d-md-table-cell">{{ $apartment->rooms }}</td>
                            <td class="text-center d-none d-md-table-cell">{{ $apartment->beds }}</td>
                            <td class="text-center d-none d-md-table-cell">{{ $apartment->bathrooms }}</td>
                            <td class="text-center d-none d-md-table-cell">{{ $apartment->mq }}</td>
                            <td class="text-center d-none d-md-table-cell">€ {{ $apartment->price }}</td>
                            <td class="text-center">
                                <a href= " {{ route('admin.apartments.show', $apartment) }}"> <i
                                    class="fa-solid fa-eye d-block d-md-inline m-1"></i></a>
                                    <a href= " {{ route('admin.apartments.edit', $apartment) }}"> <i
                                        class="fa-solid fa-pencil mx-1 d-block  d-md-inline  m-1"></i> </a>
                                        <a href= "#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $apartment->id }}"> <i
                                        class="fa-solid fa-trash text-danger d-block  d-md-inline  m-1"></i> </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                {{ $apartments->links('pagination::bootstrap-5') }}
                                    
                                </tbody>
                            </table>
        </div>

    </section>
@endsection

@section('modal')
    @foreach ($apartments as $apartment)
        @include('partials.modals.apartments._modalDelete')
    @endforeach
@endsection
