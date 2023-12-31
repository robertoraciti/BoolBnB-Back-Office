@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('head-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('style')
    <style>

        .parsley-errors-list {
            padding: 0;
            margin: 0;
        }
        .parsley-errors-list li{
            color: red;
            list-style:none ;

        }
        .button-1 {
            background-color: #a3c422;
            border: 1px solid black;
            padding: 5px 35px;
            border-radius: 20px;
            font-weight: 400;
            color: black;
        }


       .button-1:hover {
    background-color: rgba(0, 0, 0, 0.332);
    color: #dcd2c3;
  }
    </style>

@endsection


@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register New User</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="formControl">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" maxlength="100" autocomplete="name" autofocus data-parsley-trigger="keyup">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" maxlength="100" autocomplete="surname" autofocus data-parsley-trigger="keyup">

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" data-parsley-type="email" data-parsley-trigger="keyup">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label class="col-md-4 col-form-label text-md-right me-1" for="date_of_birth">Date of
                                    birth*</label>
                                <div class="col-md-6">
                                    <input class="form-control w-50 @error('date_of_birth') is-invalid @enderror"
                                        type="date"
                                        id="date_of_birth"
                                        name="date_of_birth"
                                        required
                                        max="{{ $maxDate }}"
                                        data-parsley-max-message="You must be atleast 18 years old" 
                                    >
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>You must be 18 years old</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}*</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" data-parsley-length="[8,20]" data-parsley-trigger="keyup">
                                        <input type="checkbox" class="me-2 mt-1" onclick="showPsw1()">Show Password

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required data-parsley-equalto="#password" autocomplete="new-password" data-parsley-trigger="keyup">
                                        <input type="checkbox" class="me-2 mt-1" onclick="showPsw2()">Show Password
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                    type="submit" id="saveData"
                                        onsubmit="jsFunction();return false"
                                    class="button-1"
                                    data-bs-toggle="modal"
                                    :data-bs-target="'#loginModal'"
                                  >
                                  {{ __('Register') }}
                                  </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
    function showPsw1() {
        let psw = document.getElementById("password");
        if (psw.type === "password") {
            psw.type = "text";
        } else {
            psw.type = "password";
  }

        }

        function showPsw2() {
        let psw = document.getElementById("password-confirm");
        if (psw.type === "password") {
            psw.type = "text";
        } else {
            psw.type = "password";
  }

        }

    </script>
    <script type="text/javascript">
    $('#formControl').parsley();
       
    </script>
@endsection
