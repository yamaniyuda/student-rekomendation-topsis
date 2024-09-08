<div>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="flex flex-col p-4 md:w-[50%]">
            <span class="text-2xl font-semibol text-left text-gray-900 ">
                {{ __('Rangking (Topsis)') }}
            </span>
            <p class="mt-1 text-sm font-normal text-gray-500">
                {{ __('Tabel ini menampilkan data mahasiswa untuk evaluasi menggunakan metode TOPSIS, termasuk ID, nama,
                kriteria penilaian, bobot, dan skor akhir.') }}
            </p>
        </div>
        <div class="p-4 pt-0">
            {{-- <label class="text-sm font-medium text-gray-900">Tahun</label>
            <select wire:model.live='yearOptionSelect'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option hidden selected value></option>
                @foreach ($this->yearOption as $yearOption)
                <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                @endforeach
            </select> --}}
            <label class="inline-flex items-center mt-4 cursor-pointer">
                <input type="checkbox" wire:model.live='showCalculateTopsis' class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tampilkan Perhitungan</span>
            </label>
        </div>
        @if ($rankings)
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    @for ($i = 0; $i < $rankings['final_result'][0]->keys()->count(); $i++)
                        @php
                        $data = [
                        'Name',
                        ...$rankings['final_result'][0]->except(['name', 'preference_score'])->keys(),
                        'Preference Score'
                        ]
                        @endphp


                        <th scope="col" class="px-6 text-center py-3">
                            {{ $data[$i] }}
                        </th>
                        @endfor

                </tr>
            </thead>
            <tbody>
                @foreach ($rankings['final_result'] as $ranking)
                <tr class="bg-white dark:border-gray-700">
                    @php
                    $data = [
                    'name' => $ranking['name'],
                    ...$ranking->except(['name'])
                    ]
                    @endphp
                    @foreach ($data as $key => $dt)
                    <td class="px-6 py-4 text-center">
                        @if ($key === 'name' || $key === 'preference_score')
                        {{ $dt }}
                        @else
                        {{ $dt['classification'] }}
                        @endif
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>


    @if ($showCalculateTopsis)
    <div class="bg-white mt-10 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="flex flex-col p-4 md:w-[50%]">
            <span class="text-2xl font-semibol text-left text-gray-900 ">
                {{ __('Rangkuman Perhitungan') }}
            </span>
            <p class="mt-1 text-sm font-normal text-gray-500">
                {{ __('Section ini akan menampilkan rincian perhitungan data dengan metode topsis mulai dari tahap
                normalisasi sampai tahap mencari preference skor') }}
            </p>
        </div>

        <div class="py-5 border-b-2">
            <span class="text-lg font-semibol text-left text-gray-900 p-4">1. Normalisasi</span>
            <div class="text-sm font-normal text-gray-500 p-4">
                <p>Normalisasi dilakukan untuk mengubah setiap elemen matriks keputusan sehingga setiap kriteria
                    memiliki
                    skala yang sama.</p>
                <p>Rumus normalisasi untuk setiap elemen <math xmlns="http://www.w3.org/1998/Math/MathML">
                        <mrow>
                            <mi>x</mi>
                            <sub>
                                <mi>ij</mi>
                            </sub>
                        </mrow>
                    </math> adalah:</p>
                <p><math xmlns="http://www.w3.org/1998/Math/MathML">
                        <mrow>
                            <mi>r</mi>
                            <sub>
                                <mi>ij</mi>
                            </sub>
                            <mo>=</mo>
                            <mfrac linethickness="0">
                                <mrow>
                                    <mi>x</mi>
                                    <sub>
                                        <mi>ij</mi>
                                    </sub>
                                </mrow>
                                <mrow>
                                    <mo>&#x2211;</mo>
                                    <mrow>
                                        <mi>i</mi>
                                        <mo>=</mo>
                                        <mn>1</mn>
                                        <mo>&#8290;</mo>
                                        <mi>n</mi>
                                    </mrow>
                                    <mo>(</mo>
                                    <mi>x</mi>
                                    <sub>
                                        <mi>ij</mi>
                                    </sub>
                                    <mo>)</mo>
                                    <mo>^2</mo>
                                </mrow>
                            </mfrac>
                        </mrow>
                    </math></p>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        @for ($i = 0; $i < $rankings['final_result'][0]->keys()->count() - 3; $i++)
                            @php
                            $data = [
                            'Name',
                            ...$rankings['final_result'][0]->except(['name', 'distance_positive', 'distance_negative',
                            'preference_score'])->keys(),
                            ]
                            @endphp

                            <th scope="col" class="px-6 text-center py-3">
                                {{ $data[$i] }}
                            </th>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankings['step_one']['normalize_matrix'] as $ranking)
                    <tr class="bg-white dark:border-gray-700">
                        @php
                        $data = [
                        'name' => $ranking['name'],
                        ...$ranking->except(['name', 'distance_positive', 'distance_negative'])
                        ]
                        @endphp
                        @foreach ($data as $key => $value)
                        <td class="px-6 py-4 text-center">
                            @if ($key == 'name')
                            {{ $value }}
                            @else
                            {{ $value['weight'] }}
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    <tr class="bg-white dark:border-gray-700">
                        <td class="px-6 py-4 text-center">
                            Bobot Kriteria
                        </td>
                        @foreach ($rankings['step_one']['weight_criteria'] as $weightCriteria)
                        <td class="px-6 py-4 text-center">
                            {{ $weightCriteria }}
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="py-5 border-b-2">
            <span class="text-lg font-semibol text-left text-gray-900 p-4">2. Pembobotan Matriks Normalisasi</span>
            <div class="text-sm font-normal text-gray-500 p-4">
                <p>pembobotan dilakukan dengan mengalikan matriks normalisasi dengan bobot kriteria masing-masing. Bobot
                    ini mencerminkan kepentingan relatif dari setiap kriteria dalam proses penilaian.Rumus normalisasi
                    untuk setiap elemen <math xmlns="http://www.w3.org/1998/Math/MathML">
                        <mrow>
                            <mi>V</mi>
                            <sub>
                                <mi>ij</mi>
                            </sub>
                        </mrow>
                    </math> adalah:</p>
                <span>v<sub>ij</sub> = w<sub>j</sub> × r<sub>ij</sub></span>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        @for ($i = 0; $i < $rankings['final_result'][0]->keys()->count() - 3; $i++)
                            @php
                            $data = [
                            'Name',
                            ...$rankings['final_result'][0]->except(['name', 'distance_positive', 'distance_negative',
                            'preference_score'])->keys(),
                            ]
                            @endphp

                            <th scope="col" class="px-6 text-center py-3">
                                {{ $data[$i] }}
                            </th>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankings['step_two'] as $ranking)
                    <tr class="bg-white dark:border-gray-700">
                        @php
                        $data = [
                        'name' => $ranking['name'],
                        ...$ranking->except(['name', 'distance_positive', 'distance_negative'])
                        ]
                        @endphp
                        @foreach ($data as $key => $value)
                        <td class="px-6 py-4 text-center">
                            {{ $value }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="py-5 border-b-2">
            <span class="text-lg font-semibol text-left text-gray-900 p-4">3. Menentukan Solusi Ideal Positif dan
                Negarif</span>
            <div class="text-sm font-normal text-gray-500 p-4">
                <p>Langkah ini dilakukan untuk menentukan titik referensi yang akan digunakan untuk mengevaluasi
                    seberapa dekat setiap alternatif dengan solusi ideal. Solusi ideal positif dan negatif membantu
                    dalam menilai performa alternatif berdasarkan kriteria yang telah ditetapkan.</p>
                <div class="flex flex-col">
                    <code>A<sup>+</sup><sub>j</sub> = { max(V<sub>ij</sub>)}</code>
                    <code>A<sup>−</sup><sub>j</sub> = { min(V<sub>ij</sub>)}</code>
                    <code>D<sup>+</sup><sub>i</sub> = √(Σ (V<sub>ij</sub> - A<sup>+</sup><sub>j</sub>)<sup>2</sup>)</code>
                    <code>D<sup>−</sup><sub>i</sub> = √(Σ (V<sub>ij</sub> - A<sup>−</sup><sub>j</sub>)<sup>2</sup>)</code>
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 text-center py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 text-center py-3">
                            Ideal Positif (D+)
                        </th>
                        <th scope="col" class="px-6 text-center py-3">
                            Ideal Negatif (D-)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankings['step_three'] as $ranking)
                    <tr class="bg-white dark:border-gray-700">
                        @foreach ($ranking->only(['name', 'distance_positive', 'distance_negative']) as $value)
                        <td class="px-6 py-4 text-center">
                            {{ $value }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="py-5 border-b-2">
            <span class="text-lg font-semibol text-left text-gray-900 p-4">4. Skor Preferensi</span>
            <div class="text-sm font-normal text-gray-500 p-4">
                <p>Menentukan preferensi alternatif berdasarkan perbandingan jarak tersebut. Preferensi digunakan untuk menentukan alternatif mana yang lebih dekat dengan solusi ideal positif dan lebih jauh dari solusi ideal negatif.

                </p>
                <code class="mt-2">C<sub>i</sub> = D<sup>−</sup><sub>i</sub> / (D<sup>+</sup><sub>i</sub> + D<sup>−</sup><sub>i</sub>)</code>

            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 text-center py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 text-center py-3">
                            Skor Prefernsi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankings['step_four'] as $ranking)
                    <tr class="bg-white dark:border-gray-700">
                        @foreach ($ranking->only(['name', 'preference_score']) as $value)
                        <td class="px-6 py-4 text-center">
                            {{ $value }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>