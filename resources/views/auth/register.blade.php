@extends('layouts.landingpage.app')
@section('style')
    <style>
        label {
            width: 100%;
        }

        .card-input-element {
            display: none;
        }

        .card-input {
            margin: 10px;
            padding: 00px;
        }

        .card-input:hover {
            cursor: pointer;
        }

        .card-input-element:checked+.card-input {
            box-shadow: 0 0 2px 2px #cb56fa;
        }
    </style>
@endsection
@section('content')
 <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="singUp-wrap">
                        <h2 class="title">CHOOSE ROLE</h2>
                        <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in
                            action in no time. Let's go!</p>
                        <div class="account__divider">
                        </div>
                        <form action="#" class="account__form">
                            <div class="">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-lg-4 col-sm-4">
                                        <a href="/register/student">
                                            <label>
                                                <input type="hidden" name="product" class="card-input-element" />
                                                <div class="card panel panel-default card-input">
                                                    <div class="mt-2 px-3 mb-2">
                                                        <div class="">
                                                            <div class="d-flex gap-2">
                                                                <div class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="20" stroke-dashoffset="20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M6 19v-1c0 -2.21 1.79 -4 4 -4h4c2.21 0 4 1.79 4 4v1"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="20;0"/></path><path d="M12 11c-1.66 0 -3 -1.34 -3 -3c0 -1.66 1.34 -3 3 -3c1.66 0 3 1.34 3 3c0 1.66 -1.34 3 -3 3Z"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="20;0"/></path></g></svg>
                                                                </div>
                                                                <div class="panel-heading">Student</div>
                                                            </div>
                                                            <div class="panel-body">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </a>
                                    </div>
                                 <div class="col-md-4 col-lg-4 col-sm-4">
                                        <a href="/register/teacher">
                                            <label>
                                                <input type="hidden" name="product" class="card-input-element" />
                                                <div class="card panel panel-default card-input">
                                                    <div class="mt-2 px-3 mb-2">
                                                        <div class="">
                                                            <div class="d-flex gap-2">
                                                                <div class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="20" stroke-dashoffset="20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M6 19v-1c0 -2.21 1.79 -4 4 -4h4c2.21 0 4 1.79 4 4v1"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="20;0"/></path><path d="M12 11c-1.66 0 -3 -1.34 -3 -3c0 -1.66 1.34 -3 3 -3c1.66 0 3 1.34 3 3c0 1.66 -1.34 3 -3 3Z"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="20;0"/></path></g></svg>
                                                                </div>
                                                                <div class="panel-heading">Teacher</div>
                                                            </div>
                                                            <div class="panel-body">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </a>
                                    </div>
                            </div>

                            <button type="submit" class="btn btn-two arrow-btn">Sign In<img
                                    src="assets/img/icons/right_arrow.svg" alt="img" class="injectable"></button>
                        </form>
                        <div class="account__switch">
                            <p>Don't have an account?<a href="{{ route('register') }}">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
