@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')
    <section class="container mt-5">
        <a class="ms-bt" href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-plus me-2"></i>Add new
            apartment </a>
        <div class="my-5 table-responsive">
            <table class="table">
                <thead>
                    <tr class="ms-styleB">
                        <th scope="">Id</th>
                        <th scope="">Name</th>
                        <th scope="">Address</th>
                        <th scope="col" class="text-center d-none d-md-table-cell d-flex align-items-center">Rooms</th>
                        <th scope="col" class="text-center d-none d-md-table-cell">Beds</th>
                        <th scope="col" class="text-center d-none d-md-table-cell">Bathrooms</th>
                        <th scope="col" class="text-center d-none d-md-table-cell">Mq</th>
                        <th scope="col" class="text-center d-none d-md-table-cell">Price</th>
                        <th scope="col" class="text-center">Promoted</th>
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
                                <td class="text-center"><i
                                        class="@if ($apartment->visibility == 1) ? ' fa-star fa-solid ' : ' fa-star fa-regular ' @endif "></i>
                                </td>
                                <td>
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
        border-radius: 20px;
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

    .ms-bt:hover {
        background-color: rgba(0, 0, 0, 0.615);
        color: #a3c422;
    }

    .fa-solid:hover {
        color: black;
    }

    .fa-star {
        color: goldenrod;
    }
</style>
