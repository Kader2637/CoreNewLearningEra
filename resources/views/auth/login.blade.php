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
    <section class="breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Login</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Login</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape-wrap">
            <img src="assets/img/others/breadcrumb_shape01.svg" alt="Shape" class="alltuchtopdown" />
            <img src="assets/img/others/breadcrumb_shape02.svg" alt="Shape" data-aos="fade-right" data-aos-delay="300" />
            <img src="assets/img/others/breadcrumb_shape03.svg" alt="Shape" data-aos="fade-up" data-aos-delay="400" />
            <img src="assets/img/others/breadcrumb_shape04.svg" alt="Shape" data-aos="fade-down-left"
                data-aos-delay="400" />
            <img src="assets/img/others/breadcrumb_shape05.svg" alt="Shape" data-aos="fade-left" data-aos-delay="400" />
        </div>
    </section>
    <section class="singUp-area section-py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="singUp-wrap">
                        <h2 class="title">Welcome back!</h2>
                        <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in action in no time. Let's go!</p>
                        <form action="#" class="account__form" id="loginForm">
                            <div class="form-grp">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" placeholder="email" required>
                            </div>
                            <div class="form-grp">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" placeholder="password" required>
                            </div>
                            <div class="account__check">
                                <div class="account__check-remember">
                                    <input type="checkbox" class="form-check-input" value="" id="terms-check">
                                    <label for="terms-check" class="form-check-label">Remember me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-two arrow-btn">Sign In<img src="assets/img/icons/right_arrow.svg" alt="img" class="injectable"></button>
                        </form>
                        <div id="responseMessage"></div>
                        <div class="account__switch">
                            <p>Don't have an account?<a href="{{ route('register') }}">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault();

            const formData = {
                email: $('#email').val(),
                password: $('#password').val()
            };

            $.ajax({
                url: '/api/ApiLogin',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(response) {
                    const user = response.data;

                    if (user.status === 'pending') {
                        toastr.warning('Harap tunggu konfirmasi dari admin.', 'Status Pending');
                    } else if (user.status === 'reject') {
                        toastr.error('Anda diblokir dari sistem.', 'Akses Ditolak');
                    } else if (user.status === 'accept') {
                        localStorage.setItem('token', user.token);
                        localStorage.setItem('user', JSON.stringify(user));

                        if (user.role === 'admin') {
                            window.location.href = '/admin/dashboard';
                        } else if (user.role === 'student') {
                            window.location.href = '/student/dashboard';
                        } else if (user.role === 'teacher') {
                            window.location.href = '/teacher';
                        } else {
                            window.location.href = '/home';
                        }
                    }
                },
                error: function(xhr) {
                    const errorResponse = JSON.parse(xhr.responseText);
                    toastr.error('Username atau password Salah', 'Error');
                }
            });
        });
    });
</script>
@endsection
