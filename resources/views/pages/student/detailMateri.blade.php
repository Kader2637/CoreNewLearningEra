@extends('layouts.student.app')
@section('content')
   <div class="container">
    <h1>Materi Ilmu Komputer</h1>
    <p style="text-align: justify;">
        Ilmu Komputer adalah disiplin yang mempelajari teori, pengembangan, dan penerapan sistem berbasis komputer.
        Berikut adalah beberapa konsep dasar dalam ilmu komputer:
    </p>
    <h2>1. Algoritma</h2>
    <p style="text-align: justify;">
        Algoritma adalah langkah-langkah logis untuk menyelesaikan suatu masalah. Contohnya, mencari bilangan terbesar dari sebuah array.
    </p>
    <h2>2. Struktur Data</h2>
    <p style="text-align: justify;">
        Struktur data adalah cara menyimpan dan mengorganisasi data agar dapat digunakan secara efisien. Contohnya meliputi array, list, stack, queue, tree, dan graph.
    </p>
    <h2>3. Pemrograman</h2>
    <p style="text-align: justify;">
        Pemrograman adalah proses menulis kode untuk memberitahu komputer cara menyelesaikan suatu tugas. Bahasa pemrograman populer termasuk Python, Java, C++, dan JavaScript.
    </p>
    <h2>4. Basis Data</h2>
    <p style="text-align: justify;">
        Basis data digunakan untuk menyimpan, mengelola, dan mengakses data secara efisien. Contoh sistem manajemen basis data meliputi MySQL, PostgreSQL, dan MongoDB.
    </p>
    <h2>5. Jaringan Komputer</h2>
    <p style="text-align: justify;">
        Jaringan komputer adalah koneksi antara dua atau lebih komputer untuk berbagi sumber daya. Konsep seperti protokol TCP/IP, DNS, dan model OSI adalah dasar dalam jaringan komputer.
    </p>
    <h2>6. Kecerdasan Buatan (AI)</h2>
    <p style="text-align: justify;">
        AI adalah cabang ilmu komputer yang bertujuan untuk menciptakan sistem yang dapat belajar dan melakukan tugas seperti manusia, seperti pengenalan suara, visi komputer, dan pemrosesan bahasa alami.
    </p>
    <a href="{{ route('course') }}" class="btn btn-info">Kembali</a>
    <a href="{{ route('diskusi') }}" class="btn btn-info ml-auto">Diskusi room</a>
</div>

@endsection
