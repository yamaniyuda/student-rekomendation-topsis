<div>
    <div class="overflow-hidden bg-white rounded-lg">
        <img src="{{ URL::to('/mth.png') }}" class="h-[30vh] w-[100%] object-cover" />
        <div class="flex justify-center items-center flex-col">
            <img src="{{ asset('storage/' . $student->photo_profile) }}" class="rounded-full w-[20vh] h-[20vh] -mt-16" />
            <h1 class="mt-2 text-xl font-bold">{{ $student->user->name }}</h1>
            <h1 class="text-sm text-gray-700">{{ $student->user->email }}</h1>
        </div>
        <div class="mx-5 mb-5 w-100 ">
            <div class="flex flex-col">
                <span class="text-gray-700">Alamat</span>
                <span class="-mt-1">{{ $student->address }}</span>
            </div>
            <table class="w-[100%] mt-5">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 w-[100%]">
                    <tr>
                        @foreach(App\Models\Criteria::all() as $criteria)
                            <th>
                                {{ $criteria->name }} ({{ $criteria->symbol }})
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $data = $student->studentScore[0]->toArray();
                        usort($data['criteria_details'], function ($a, $b) {
                            $numA = (int) substr($a['criteria']['symbol'], 1);
                            $numB = (int) substr($b['criteria']['symbol'], 1);
    
                            return $numA - $numB;
                        });
    
                    @endphp
                    <tr class="bg-white border-b hover:bg-gray-50">
                        @foreach($data['criteria_details'] as $dt)
                            <td class="text-center">
                                {{ data_get($dt, 'classification') ?? ' ' }}
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>