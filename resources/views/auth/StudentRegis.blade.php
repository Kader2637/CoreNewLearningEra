@extends('layouts.student.app')
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
                    <h2 class="title">Student Register</h2>
                    <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in
                        action in no time. Let's go!</p>
                    <div class="account__social">

                    </div>
                    <div class="account__divider">
                        <span>or</span>
                    </div>
                    <form action="#" class="account__form">
                        <div class="form-grp">
                            <label for="email">Nama Lengkap</label>
                            <input id="email" type="text" placeholder="nama lengkap">
                        </div>
                        <div class="form-grp">
                            <label for="email">Email</label>
                            <input id="email" type="text" placeholder="email">
                        </div>
                        <div class="form-grp">
                            <label for="password">Password</label>
                            <input id="password" type="text" placeholder="password">
                        </div>
                        <div class="account__check">
                            <div class="account__check-remember">
                                <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                <label for="terms-check" class="form-check-label">Remember me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-two arrow-btn">Sign<img
                                src="{{ asset('assets/img/icons/right_arrow.svg') }}" alt="img" class="injectable"></button>
                    </form>
                    <div class="account__switch">
                        <p><a href="{{ route('register') }}">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
