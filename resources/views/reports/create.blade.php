  <x-app-layout>
      @slot('header')
          {{ _('情報登録') }}
      @endslot

      <div class="max-w-4xl mx-auto py-10 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="mt-10 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('コース') }}</h2>
                      <div class="mt-0 col-span-2">
                          @foreach ($categories as $category)
                              <label>
                                  <input type="radio" name="category_id" value="{{ $category->id }}">
                                  {{ $category->name }}
                              </label>
                          @endforeach
                      </div>
                  </div>

                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('地名') }}</h2>
                      <div class="mt-0 col-span-2">
                          <textarea name="localname" class="w-full h-full"></textarea>
                      </div>
                  </div>


                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('写真') }}</h2>
                      <div class="mt-0 col-span-2">
                          <label>
                              <input type="file" name="photo2" id="imgFile" accept="photo2/*"
                                  class="hidden input-preview__src">
                              <img id="imgPreview" class="w-full h-80 border border-solid border-black object-contain"
                                  src="https://placehold.jp/15/ccc/000/300x300.png?text=%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%92%E9%81%B8%E6%8A%9E%E3%81%97%E3%81%A6%E3%81%8F%E3%81%A0%E3%81%95%E3%81%84">
                          </label>
                      </div>
                  </div>

                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('場所') }}</h2>
                      <input type="hidden" name="latitude" id="latitude">
                      <input type="hidden" name="longitude" id="longitude">
                      <div class="mt-0 col-span-2">
                          <div class="w-full h-80 border border-solid border-black">
                              <div class="h-full" id="map"></div>
                          </div>
                      </div>
                  </div>

                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('概要') }}</h2>
                      <div class="mt-0 col-span-2">
                          <textarea name="summary" class="w-full h-full"></textarea>
                      </div>
                  </div>

                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('詳細URL') }}</h2>
                      <div class="mt-0 col-span-2">
                          <input type="url" name="url" class="w-full">
                      </div>
                  </div>

                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('作成日付') }}</h2>
                      <div class="mt-0 col-span-2">
                          <div class="grid grid-cols-5">
                              <div class="col-span-2">
                                  <input type="datetime-local" name="create_date" class="w-full">
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="mt-2 grid grid-cols-3 gap-6">
                      <h2 class="text-lg font-medium content-center">{{ __('更新日付') }}</h2>
                      <div class="mt-0 col-span-2">
                          <div class="grid grid-cols-5">
                              <div class="col-span-2">
                                  <input type="datetime-local" name="update_date" class="w-full">
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="mt-10">
                      <input type="submit" value="{{ __('登録') }}" class="border border-black px-3 py-1">
                  </div>
                  <div class="mt-10">
                      <input type="submit" value="{{ __('更新') }}" class="border border-black px-3 py-1">
                  </div>
                  <div class="mt-10">
                      <input type="submit" value="{{ __('削除') }}" class="border border-black px-3 py-1">
                  </div>

              </form>
          </div>
      </div>

      <script>
          const fileForm = document.getElementById('imgFile'); // IDがimgFileの要素を取得
          const filePreview = document.getElementById('imgPreview'); // IDがimgPreviewの要素を取得

          // フォームの変更のイベントに処理を追加
          fileForm.onchange = function() {
              const reader = new FileReader(); // 読み込み用Readerを用意

              // Rederで読み込んだときの処理を追加
              reader.onload = function(e) {
                  filePreview.src = e.target.result // 読み取りした内容をプレビュー用要素に指定
              };

              reader.readAsDataURL(this.files[0]); // フォームで読み込んだファイルをReaderで読み取り
          };
      </script>
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
