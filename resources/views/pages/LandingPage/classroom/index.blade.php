@extends('layouts.landingpage.app')
@section('content')
    <section class="breadcrumb__area breadcrumb__bg"
        style="background-image: url('{{ asset('assets/img/bg/breadcrumb_bg.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Kelas</h3>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            <span property="itemListElement" typeof="ListItem">Kelas</span>
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
    <section class="pt-5 pb-4 courses-area" style="background-image: url('assets/img/bg/courses_bg.jpg');">
        <div class="container">
            <div id="classroom-container" class="row d-flex justify-content-center">
            </div>
        </div>
    </section>

    <div id="no-data" class="mt-5 mb-5 text-center" style="display: none;">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('nodatalanding.jpg') }}" width="400px" alt="">
        </div>
        <h3>Belum ada kelas</h3>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            const container = $('#classroom-container');
            const loading = $('#loading');
            const noData = $('#no-data');

            loading.show();
            noData.hide();
            container.empty();

            $.ajax({
                url: '/api/classroom',
                method: 'GET',
                success: function(response) {
                    loading.hide();

                    if (response.data && response.data.length > 0) {
                        response.data.forEach(classroom => {
                            const thumbnailPath = classroom.thumbnail ?
                                `{{ asset('storage/${classroom.thumbnail}') }}` :
                                '{{ asset('default-thumbnail.jpg') }}';

                            const description = classroom.description ?
                                (classroom.description.length > 90 ?
                                    classroom.description.substring(0, 90) + '...' :
                                    classroom.description) :
                                'No description available';

                            const cardHtml = `
                        <div class="col-12 col-xl-4 col-lg-5">
                            <div class="card courses__item shine__animate-item">
<a href="#" class="shine__animate-link">
    <img src="${thumbnailPath}" alt="${classroom.name}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;" />
</a>

                                <div class="card-body">
                                    <ul class="mb-3 courses__item-meta list-wrap list-unstyled">
                                        <li class="courses__item-tag">
                                            <a href="#">${classroom.statusClass}</a>
                                        </li>
                                    </ul>
                                    <h5 class="card-title">
                                        <a href="#">${classroom.name}</a>
                                    </h5>
                                    <p class="description">${description}</p>
                                    <p class="author">
                                        Teacher : <a href="#">${classroom.user_name || 'Unknown'}</a>
                                    </p>
                                    <div class="mt-3">
                                        <a href="/login">
                                            <button class="w-100 join-button"
                                                style="background: linear-gradient(90deg, #1e3c72, #2a5298); color: white; font-size: 13px; padding: 13px; border: none; border-radius: 30px; cursor: pointer; transition: transform 0.2s, box-shadow 0.3s; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
                                                Bergabung
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                            container.append(cardHtml);
                        });
                    } else {
                        noData.show();
                    }
                },
                error: function(error) {
                    loading.hide();
                    noData.show();
                }
            });
        });
    </script>
@endsection
