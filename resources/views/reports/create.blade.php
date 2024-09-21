 <x-app-layout>
     @slot('header')
         {{ _('情報登録') }}
     @endslot

     <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
         @csrf

         <h2>{{ __('コース') }}</h2>
         @foreach ($categories as $category)
             <label>
                 <input type="radio" name="category_id" value="{{ $category->id }}">
                 {{ $category->name }}
             </label>
         @endforeach
         <h2>{{ __('写真') }}</h2>
         <label>
             <input type="file" name="image" id="imgFile" accept="image/*">
             <img id="imgPreview"
                 src="https://placehold.jp/15/ccc/000/300x300.png?text=%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%92%E9%81%B8%E6%8A%9E%E3%81%97%E3%81%A6%E3%81%8F%E3%81%A0%E3%81%95%E3%81%84">
         </label>

         <h2>{{ __('地名') }}</h2>
         <input type="hidden" name="localname" id="localname">

         <h2>{{ __('場所') }}</h2>
         <input type="hidden" name="latitude" id="latitude">
         <input type="hidden" name="longitude" id="longitude">

         <h2>{{ __('概要') }}</h2>
         <textarea name="summary"></textarea>

         <h2>{{ __('詳細URL') }}</h2>
         <input type="tel" name="url">

         <h2>{{ __('報告日') }}</h2>
         <input type="datetime-local" name="url">

         <div>
             <input type="submit" value="{{ __('登録') }}">
             <input type="submit" value="{{ __('更新') }}">
             <input type="submit" value="{{ __('削除') }}">

         </div>
     </form>
 </x-app-layout>
