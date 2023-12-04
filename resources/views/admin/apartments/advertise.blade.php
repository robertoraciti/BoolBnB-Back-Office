@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('style')
    <style>

        .button {
            cursor: pointer;
            font-weight: 500;
            left: 3px;
            line-height: inherit;
            position: relative;
            text-decoration: none;
            text-align: center;
            border-style: solid;
            border-width: 1px;
            border-radius: 3px;
            -webkit-appearance: none;
            -moz-appearance: none;
            display: inline-block;
        }
        
        .button--small {
            padding: 10px 20px;
            font-size: 0.875rem;
        }
        
        .button--green {
            outline: none;
            background-color: #64d18a;
            border-color: #64d18a;
            color: white;
            transition: all 200ms ease;
        }
        
        .button--green:hover {
            background-color: #8bdda8;
            color: white;
        }

        #form-button {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <h1>{{$apartment->name}}</h1>
        <div class="mb-5">

            <i class="fa-solid fa-location-dot text-danger me-2"></i><span>Address:</span>
            <span> {{ $apartment->address }}</span>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="image">
                    <img src="{{ $apartment->cover_image ? asset('/storage/'. $apartment->cover_image) : "https://placehold.co/400" }}" class="img-fluid" id="cover_image_preview">
                </div>
            </div>
            <div class="col-6">
                

                <h2>Promote your apartment</h1>  
                <h5>Choose your plan</h5>  
                <form action="{{ route('admin.advertisement.checkout', $apartment->id) }}" method="post">
                    @csrf
                    <select name="advertisement_id" id="advertisement_id" class="form-select">
                        @foreach ($advertisePlans as $plan)
                            <option value="{{ $plan->id }}" @if (old('advertisement_id') == $plan->id) selected @endif>
                                {{ $plan->label }} - €{{$plan->price}} - {{$plan->duration}} hours
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-success my-5" id="form-button">Promote</button>
                    
                </form>
                <div id="dropin-container"></div>
                <button id="submit-button" class="button button--small button--green">Purchase</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/web/dropin/1.10.0/js/dropin.js"></script>

    <script>
    var button = document.querySelector('#submit-button');
    let formButton = document.getElementById('form-button');

    braintree.dropin.create({
    authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
    selector: '#dropin-container'
    }, function (err, instance) {
    if (err) {
        // An error in the create call is likely due to
        // incorrect configuration values or network issues
        return;
    }

    button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
        if (err) {
            // An appropriate error will be shown in the UI
            return;
        } else {
            formButton.style.display = "block"
            button.style.display = "none"
        }

        // Submit payload.nonce to your server
        });
    })
    });
    </script>
        
@endsection