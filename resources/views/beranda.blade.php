<style>
    #map {
        height: calc(100vh - 4rem);
        width: 100%;
        border: 2px solid black;
        border-radius: 8px;
    }

    .font-lilita {
        font-family: 'Lilita One', cursive;
    }
</style>

<x-beranda.main title="Beranda">
    <div class="flex flex-wrap">
        <div class="flex-1 p-6 bg-base-100 m-4 rounded-lg shadow-lg">
            <h1 class="text-5xl text-center font-bold text-black font-lilita">
                Monitoring Karhutla Kelurahan Mundam Kecamatan Medang Kampai
            </h1>
            <p class="mt-5 text-base-content text-center">Di sini, Anda bisa menambahkan informasi lebih lanjut tentang
                program
                pemantauan kebakaran hutan di wilayah Kelurahan Mundam, Kecamatan Medang Kampai. Konten ini memberikan
                gambaran umum tentang kegiatan pemantauan, tujuan, dan pentingnya tindakan pencegahan untuk menjaga
                lingkungan.</p>
            <table class="table table-zebra mt-3">
                <thead>
                    <tr class="text-center">
                        @foreach (['No', 'Lokasi', 'Radius', 'Level', 'Register'] as $item)
                            <th class="uppercase font-bold">{{ $item }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($lokasi as $i => $item)
                        <tr>
                            <th>{{ $i + 1 }}</th>
                            <td class="font-semibold uppercase">{{ $item->lat . ' , ' . $item->long }}</td>
                            <td class="font-semibold uppercase">{{ $item->radius . ' meter' }}</td>
                            <td class="font-semibold uppercase">{{ $item->level }}</td>
                            <td class="font-semibold uppercase">{{ $item->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center font-semibold uppercase">Data lokasi tidak tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex-1 p-4 bg-base-100 m-4 rounded-lg shadow-lg">
            <h1 class="text-5xl text-center font-bold text-black mb-4">Peta Desa Mundam</h1>
            <div id="map"></div>
        </div>
    </div>
</x-beranda.main>

<script>
    var map = L.map('map').setView([1.5393453, 101.6149666], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([1.5393453, 101.6149666]).addTo(map)
        .bindPopup('Desa Mundam')
        .openPopup();

    var lokasi = @json($lokasi);

    lokasi.forEach(function(item) {
        var marker = L.marker([item.lat, item.long]).addTo(map);

        L.circle([item.lat, item.long], {
            color: item.level === 'rendah' ? 'green' : item.level === 'menengah' ? 'orange' : 'red',
            fillColor: item.level === 'rendah' ? 'green' : item.level === 'menengah' ? 'orange' : 'red',
            fillOpacity: 0.2,
            radius: item.radius
        }).addTo(map);

        marker.bindPopup(`
        <b>Lat:</b> ${item.lat}<br>
        <b>long:</b> ${item.long}<br>
        <b>Radius:</b> ${item.radius} meters<br>
        <b>Level:</b> ${item.level}
    `);
    });
</script>
