<x-app-layout>
    @slot('header')
        {{ _('観光マップ') }}
    @endslot

    <div class="max-w-4xl mx-auto py-10 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mt-2 grid grid-cols-3 gap-6">
                    {{-- <h2 class="text-lg font-medium content-center">{{ __('場所') }}</h2>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude"> --}}
                    <div class="mt-0 col-span-2">
                        <div class="w-full h-80 border border-solid border-black">
                            <div class="h-full" id="map"></div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        // 地図表示
        // すべてのファイルが読み込まれてから処理
        window.onload = (e) => {
            // 地図表示
            const map = L.map('map').setView([38.9866042, 141.1137843], 15); // centerとzoomの値を指定
            L.tileLayer('http://tile.openstreetmap.jp/{z}/{x}/{y}.png').addTo(map); // 地図タイルを表示
            // フォーム要素を取得
            const lat = document.getElementById('latitude');
            const lng = document.getElementById('longitude');

            let clicked;
            let marker;

            // クリックでピン立て
            map.on('click', function(e) {
                if (clicked !== true) {
                    clicked = true;
                    marker = L.marker([
                        e.latlng['lat'],
                        e.latlng['lng']
                    ], {
                        draggable: true
                    }).addTo(map);

                    lat.value = e.latlng['lat'];
                    lng.value = e.latlng['lng'];

                    marker.on('dragend', function(event) {
                        const position = marker.getLatLng();

                        lat.value = position.lat;
                        lng.value = position.lng;
                    });
                }
            });
        }
    </script>
</x-app-layout>
