<x-dashboard.index title="Dashboard">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6">
        @foreach (['total_pengajuan', 'total_valid'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                      {{ $type == 'total_pengajuan' ? 'bg-blue-300' : '' }}
                      {{ $type == 'total_valid' ? 'bg-green-300' : '' }}
                      p-3 mr-4 text-gray-700 rounded-full"></span>
                <div>
                    <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                        {{ ${$type} }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['pengajuan_masuk'] as $key => $jenis)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $jenis) }} <span
                            class="badge badge-xs sm:badge-sm uppercase badge-secondary">baru</span>
                    </h1>
                    <p class="text-sm opacity-60">Berdasarkan data pada {{ date('d-m-Y') }}</p>
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5">
                    @forelse (${$jenis} as $index => $data)
                        <div class="flex items-center gap-5 pt-3">
                            <h1>{{ $index + 1 }}</h1>
                            <div>
                                <h1 class="opacity-50 text-sm font-semibold">
                                    #{{ $data->lat . ' , ' . $data->long }}</h1>
                                <h1 class="font-semibold text-sm sm:text-[15px] hover:underline cursor-pointer">
                                    {{ $data->radius . '(m) ' . '(' . $data->level . ')' }}</h1>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center gap-5 pt-3">
                            <h1>Pengajuan tidak ada.</h1>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.index>
