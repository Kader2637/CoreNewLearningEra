@extends('layouts.landingpage.app')

@section('title', 'Kelas – New Learning Era')

@section('style')
    <style>
        :root {
            --nl-primary: #0f172a;
            --nl-secondary: #6b7280;
            --nl-border: #e5e7eb;
            --nl-soft: #f9fafb;
            --nl-radius: 18px;
        }

        /* HERO KELAS */
        .kelas-hero {
            background: #ffffff;
            border-bottom: 1px solid var(--nl-border);
            padding: 50px 0 30px;
        }

        .kelas-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--nl-primary);
        }

        .kelas-subtitle {
            color: var(--nl-secondary);
            max-width: 560px;
        }

        .kelas-search-wrapper {
            position: relative;
        }

        .kelas-search-input {
            border-radius: 999px;
            border: 1px solid var(--nl-border);
            padding-left: 42px;
            height: 42px;
            font-size: .9rem;
        }

        .kelas-search-wrapper i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            font-size: .9rem;
            color: #9ca3af;
        }

        /* SECTION LIST KELAS */
        .kelas-section {
            background: var(--nl-soft);
            padding: 35px 0 70px;
            min-height: 60vh;
        }

        .course-card {
            border-radius: var(--nl-radius);
            border: 1px solid var(--nl-border);
            overflow: hidden;
            background: #ffffff;
            transition: .18s ease;
            height: 100%;
        }

        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 35px rgba(15, 23, 42, .10);
        }

        .course-img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            transition: .5s ease;
        }

        .course-card:hover .course-img {
            transform: scale(1.03);
        }

        .course-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--nl-primary);
            margin-bottom: 3px;
            line-height: 1.4;
        }

        .course-desc {
            font-size: .85rem;
            color: var(--nl-secondary);
            min-height: 38px;
        }

        .join-btn {
            width: 100%;
            padding: 10px;
            border-radius: 999px;
            font-size: .85rem;
            border: none;
            color: white;
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            transition: .2s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, .35);
        }

        .join-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, .45);
        }

        #no-data img {
            max-width: 330px;
        }
    </style>
@endsection


@section('content')

    {{-- HERO ATAS --}}
    <section class="kelas-hero">
        <div class="container">
            <h1 class="kelas-title mb-2">Kelas Tersedia</h1>
            <p class="kelas-subtitle mb-3">
                Jelajahi berbagai kelas yang dapat membantu pengembangan skill Anda.
            </p>

            {{-- SEARCH --}}
            <div class="kelas-search-wrapper mt-3">
                <i class="bi bi-search"></i>
                <input type="text" id="search-class" class="form-control kelas-search-input"
                       placeholder="Cari kelas berdasarkan nama atau mentor...">
            </div>
        </div>
    </section>

    {{-- SECTION LIST KELAS --}}
    <section class="kelas-section">
        <div class="container">

            {{-- GRID CARD --}}
            <div id="classroom-container" class="row g-4"></div>

            {{-- NO DATA DI DALAM CONTAINER, BUKAN DIHAPUS OLEH empty() --}}
            <div id="no-data"
                 class="d-none text-center py-5">
                <img src="{{ asset('nodatalanding.jpg') }}" alt="">
                <h4 class="mt-3 text-secondary">Belum ada kelas ditemukan</h4>
                <p class="text-muted mb-0" style="font-size:.9rem;">
                    Kelas akan segera ditambahkan.
                </p>
            </div>

        </div>
    </section>

@endsection


@section('script')
    <script>
        $(document).ready(function () {
            const container   = $('#classroom-container');
            const noData      = $('#no-data');
            const searchInput = $('#search-class');

            let allClassrooms = [];

            function render(list) {
                // hapus semua card
                container.empty();

                if (!list || list.length === 0) {
                    // tampilkan no-data
                    noData.removeClass('d-none');
                    return;
                }

                // sembunyikan no-data
                noData.addClass('d-none');

                list.forEach(c => {
                    const thumbnail = c.thumbnail
                        ? `/storage/${c.thumbnail}`
                        : `/default-thumbnail.jpg`;

                    const desc = c.description
                        ? (c.description.length > 95 ? c.description.substring(0, 95) + '...' : c.description)
                        : 'Tidak ada deskripsi';

                    const mentor = c.user_name || "Tidak diketahui";

                    const html = `
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="course-card">
                                <img src="${thumbnail}" class="course-img" alt="">
                                <div class="p-3">
                                    <h5 class="course-title">${c.name}</h5>
                                    <p class="course-desc">${desc}</p>
                                    <p class="text-secondary m-0" style="font-size:.8rem;">
                                        Mentor: <strong>${mentor}</strong>
                                    </p>
                                    <a href="/login">
                                        <button class="join-btn mt-3">Bergabung</button>
                                    </a>
                                </div>
                            </div>
                        </div>`;

                    container.append(html);
                });
            }

            // Ambil data awal
            $.ajax({
                url: '/api/classroom',
                method: 'GET',
                success: function (res) {
                    allClassrooms = res.data || [];
                    render(allClassrooms);
                },
                error: function () {
                    render([]);
                }
            });

            // Search live
            searchInput.on('input', function () {
                const key = searchInput.val().toLowerCase();

                const filtered = allClassrooms.filter(c => {
                    return (c.name || '').toLowerCase().includes(key) ||
                           (c.user_name || '').toLowerCase().includes(key);
                });

                render(filtered);
            });

        });
    </script>
@endsection
