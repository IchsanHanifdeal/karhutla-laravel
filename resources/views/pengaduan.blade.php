<style>
    #map {
        height: calc(40vh - 4rem);
        width: 100%;
        border: 2px solid black;
        border-radius: 8px;
    }

    .font-lilita {
        font-family: 'Lilita One', cursive;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
</style>
<x-beranda.main title="Pengaduan">
    <div class="container">
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6 text-center">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
                Form Pengaduan Karhutla
            </h1>
            <div id="map" class="h-96 mb-6 rounded-lg"></div>
            <form id="reportForm" class="space-y-6 bg-gray-50 p-6 rounded-lg shadow-md" method="POST"
                action="{{ route('pengaduan.store') }}">
                @csrf
                <div class="flex flex-col md:flex-row md:space-x-6">
                    <div class="flex-1">
                        <label for="lat" class="block text-gray-700 font-semibold mb-2">Latitude:</label>
                        <input type="text" id="lat" name="lat" readonly
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                    </div>
                    <div class="flex-1">
                        <label for="lng" class="block text-gray-700 font-semibold mb-2">Longitude:</label>
                        <input type="text" id="lng" name="lng" readonly
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                    </div>

                </div>
                <div>
                    <label for="radius" class="block text-gray-700 font-semibold mb-2">Radius (M):</label>
                    <input type="number" id="radius" name="radius" min="1" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                </div>
                <div>
                    <label for="level" class="block text-gray-700 font-semibold mb-2">Level:</label>
                    <select id="level" name="level" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                        <option value="">Pilih level</option>
                        <option value="rendah">Rendah</option>
                        <option value="menengah">Menengah</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-secondary capitalize">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([1.5393453, 101.6149666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;
        var circle;

        map.on('click', function(e) {
            var latLng = e.latlng;

            if (marker) {
                marker.remove();
            }
            if (circle) {
                circle.remove();
            }

            marker = L.marker(latLng).addTo(map)
                .bindPopup('Lat: ' + latLng.lat + ', Lng: ' + latLng.lng)
                .openPopup();

            document.getElementById('lat').value = latLng.lat;
            document.getElementById('lng').value = latLng.lng;

            updateCircle();
        });

        document.getElementById('radius').addEventListener('input', updateCircle);
        document.getElementById('level').addEventListener('change', updateCircle);

        function updateCircle() {
            var lat = parseFloat(document.getElementById('lat').value);
            var lng = parseFloat(document.getElementById('lng').value);
            var radius = document.getElementById('radius').value;
            var level = document.getElementById('level').value;

            if (!isNaN(lat) && !isNaN(lng)) {
                if (circle) {
                    circle.remove();
                }

                var color;
                switch (level) {
                    case 'rendah':
                        color = 'green';
                        break;
                    case 'menengah':
                        color = 'orange';
                        break;
                    case 'tinggi':
                        color = 'red';
                        break;
                    default:
                        color = 'red';
                }

                circle = L.circle([lat, lng], {
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.2,
                    radius: parseFloat(radius)
                }).addTo(map);
            }
        }
    </script>

</x-beranda.main>
