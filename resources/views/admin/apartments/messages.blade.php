@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">

    <div class="mt-4">
        <h2>Messages for {{ $apartment->name }}</h2>
    </div>

    <table class="table mt-2">
        <thead>
            <tr>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Sent</th>
                <th scope="col">Text</th>
                {{-- <th scope="col">Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->created_at }}</td>
                <td>{{ $message->text }}</td>
                {{-- <td>
                    <a href= " {{ route('admin.apartments.show', $apartment) }}"> <i
                        class="fa-solid fa-eye"></i></a>
                        <a href= " {{ route('admin.apartments.edit', $apartment) }}"> <i
                            class="fa-solid fa-pencil mx-1 "></i> </a>
                            <a href= "#" data-bs-toggle="modal"
                            data-bs-target="#deleteModal-{{ $apartment->id }}"> <i
                            class="fa-solid fa-trash text-danger"></i> </a>
                        </td> --}}
                    </tr>
                    
                @endforeach
                {{ $messages->links('pagination::bootstrap-5') }}
                    
        </tbody>
    </table>
</div>
@endsection