<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex justify-start items-center">
        <x-application-logo class="block h-12" />
        <span class="font-semibold text-2xl">Aplikasi Manajemen Siswa</span>
    </div>

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Selamat Datang di Aplikasi Manajemen Siswa
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Di sini, Anda dapat dengan mudah mengelola data siswa dan mendapatkan wawasan yang berharga tentang performa
        mereka. Gunakan dashboard ini untuk melihat rekomendasi siswa terbaik berdasarkan metode TOPSIS yang kami
        terapkan.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            <img src="{{ URL::to('/student.svg') }}" width="30" alt="">
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                <a href="https://laravel.com/docs">Manajemen Siswa</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Modul Manajemen Siswa kami dirancang untuk membantu Anda dalam mengelola data siswa secara efisien dan
            efektif. Dengan antarmuka yang intuitif dan fitur yang kuat, Anda dapat melakukan berbagai tugas manajerial
            dengan mudah
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('students.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Lihat Siswa

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd"
                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <img src="{{ URL::to('/list.svg') }}" width="30" alt="">
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                <a href="https://laracasts.com">Kreteria</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Dalam aplikasi ini, kami menggunakan metode TOPSIS (Technique for Order Preference by Similarity to Ideal
            Solution) untuk mengevaluasi dan merekomendasikan siswa berdasarkan berbagai kriteria yang telah ditentukan
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('criteria.index') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Lihat kriteria

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd"
                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <img src="{{ URL::to('/ranking.svg') }}" width="30" alt="">
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                <a href="https://tailwindcss.com/">Rengking (Topsis)</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Di menu Rangking TOPSIS, Anda dapat melihat peringkat siswa berdasarkan analisis menggunakan metode TOPSIS.
            Metode ini memungkinkan kami untuk memberikan penilaian yang objektif dan komprehensif dengan
            mempertimbangkan berbagai kriteria yang telah ditentukan.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('ranking.topsis') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Lihat Rengking

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                    <path fill-rule="evenodd"
                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <img src="{{ URL::to('/lock.svg') }}" width="30" alt="">
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                Autentikasi
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Fitur autentikasi kami dirancang untuk memastikan keamanan data dan kontrol akses yang efektif dalam
            aplikasi. Dengan fitur ini, Anda dapat mengelola dan mengamankan akses pengguna dengan cara yang mudah dan
            terintegrasi.
        </p>
    </div>
</div>