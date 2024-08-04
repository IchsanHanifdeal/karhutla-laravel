<x-dashboard.index title="Kelola Pengajuan">
    <div class="flex gap-5">
        @foreach (['manajemen_pengajuan'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola Pengajuan dengan cermat</p>
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    @foreach (['no', 'Lokasi', 'Radius', 'Level', 'validasi', 'last update', 'register', ''] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pengajuan->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada pengajuan</td>
                                    </tr>
                                @endif
                                @foreach ($pengajuan as $i => $item)
                                    <tr class="whitespace-nowrap uppercase">
                                        <th>{{ $i + 1 }}</th>
                                        <td class="uppercase font-semibold">{{ $item->lat . ' , ' . $item->long }}</td>
                                        <td class="uppercase font-semibold">
                                            {{ $item->radius . ' meter' }}
                                        </td>
                                        <td class="font-semibold">{{ $item->level }}</td>
                                        <td class="font-semibold">{{ $item->validasi }}</td>
                                        <td class="uppercase">{{ $item->updated_at }}</td>
                                        <td class="uppercase">{{ $item->created_at }}</td>
                                        @if ($item->validasi === 'diajukan')
                                            <td>
                                                <button
                                                    onclick="document.getElementById('terima_pengajuan_modal_{{ $item->id_lokasi }}').showModal();initUpdate('pengajuan', {{ $item->id_lokasi }});"
                                                    class="btn btn-emerald m-2">Terima</button> |
                                                <button
                                                    onclick="document.getElementById('tolak_pengajuan_modal_{{ $item->id_lokasi }}').showModal();"
                                                    class="btn btn-outline btn-error m-2">Tolak</button>
                                            </td>
                                        @elseif ($item->validasi === 'diterima')
                                            <td>
                                                <x-lucide-check class="stroke-emerald-500"
                                                    style="width: 20px; height: 20px;" />
                                            </td>
                                        @else
                                            <td class="uppercase">undefined</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.index>
@foreach ($pengajuan as $i => $pe)
    @foreach (['terima', 'tolak'] as $action)
        <dialog id="{{ $action }}_pengajuan_modal_{{ $pe->id_lokasi }}"
            class="modal modal-bottom sm:modal-middle">
            <form action="{{ route($action . '_' . 'pengajuan', ['id_lokasi' => $pe->id_lokasi]) }}" method="POST"
                class="modal-box">
                @csrf
                @if ($action === 'tolak')
                    @method('DELETE')
                @else
                    @method('PUT')
                @endif
                <h3 class="modal-title capitalize">
                    {{ ucfirst($action) }} pengajuan
                </h3>
                <div class="modal-body">
                    <div class="input-label">
                        <h1 class="label">Anda sedang {{ $action }} pengajuan untuk data karhutla
                            {{ $pe->lat . ' , ' . $pe->long }} dengan radius {{ $pe->radius . '(meter)' }}. Apakah
                            Anda yakin ingin melanjutkan?</h1>
                    </div>
                </div>
                <div class="modal-action">
                    <button
                        onclick="document.getElementById('{{ $action }}_pengajuan_modal_{{ $pe->id_lokasi }}').close();"
                        class="btn" type="button">Tutup</button>
                    <button type="submit" class="btn btn-secondary capitalize">
                        {{ ucfirst($action) }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach
@endforeach
