<!-- meta tags and other links -->
@php
    use Carbon\Carbon;
@endphp

@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen pb-[100px] relative overflow-y-auto">

        @section('title-active')
            {{ $module }}</span>
        @endsection

        @include('user.layouts._nav')

        <!-- Konten Detail Donasi -->
        <div class="p-4">

            <div class="flex items-center">
                <h3 class="!text-[20px] font-bold leading-6 text-gray-900">Sejarah Masjid</h3>
            </div>
            <div class="p-2 !border-s-4 !border-green-600 bg-white rounded-lg mt-2">
                <p class="text-sm text-gray-600">{!! nl2br(e($sejarah->isi)) !!}</p>
            </div>

            <div class="flex items-center mt-4">
                <h3 class="!text-[20px] font-bold leading-6 text-gray-900">Visi</h3>
            </div>
            <ul class="!list-disc mt-2 text-sm !ms-[22px]">
                @foreach ($visi as $v)
                    <li>{{ $v->item }}</li>
                @endforeach
            </ul>

            <div class="flex items-center mt-3">
                <h3 class="!text-[20px] font-bold leading-6 text-gray-900">Misi</h3>
            </div>
            <ul class="!list-disc mt-2 text-sm !ms-[22px]">
                @foreach ($misi as $m)
                    <li>{{ $m->item }}</li>
                @endforeach
            </ul>

            <div class="embed-responsive embed-responsive-16by9 mt-6 rounded-lg">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.366767239663!2d119.49635211011523!3d-5.204917679738017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee33c061a2f93%3A0x5520dae652991f7a!2sMasjid%20Agung%20Sultan%20Alauddin!5e0!3m2!1sid!2sid!4v1748535526912!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <style>
                .embed-responsive {
                    position: relative;
                    display: block;
                    width: 100%;
                    height: 55vh;
                    padding: 0;
                    overflow: hidden;
                }

                .embed-responsive::before {
                    content: "";
                    display: block;
                    padding-top: 56.25%;
                    /* 16:9 aspect ratio */
                }

                .embed-responsive .embed-responsive-item,
                .embed-responsive iframe,
                .embed-responsive embed,
                .embed-responsive object,
                .embed-responsive video {
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 100%;
                    height: 100%;
                    border: 0;
                }
            </style>
            @include('user.layouts._footer')
            @include('user.layouts._sidebar')
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>
