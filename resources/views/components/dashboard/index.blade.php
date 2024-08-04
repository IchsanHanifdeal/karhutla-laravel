<!DOCTYPE html>

<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:url" content="https://...">
    <meta property="og:type" content="website">
    <meta property="og:title" content="....">
    <meta property="og:description" content="....">
    <meta property="og:image:width" content="470">
    <meta property="og:image:height" content="470">

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="...">
    <meta property="twitter:url" content="https://...">
    <meta name="twitter:title" content="....">
    <meta name="twitter:description" content="....">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <title>{{ $title ?? 'Beranda' }} | Monitoring Karhutla Kelurahan Mundam Kecamatan Medang Kampai</title>
    <meta name="description" content="....">

    @vite('resources/css/app.css')
</head>

<main title="{{ $title }}" class="!p-0" full>
    <div class="drawer md:drawer-open">
        <input id="aside-dashboard" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @include('components.dashboard.navbar')
            <div class="p-4 md:p-5 bg-stone-100 w-full overflow-y-scroll">
                <div class="flex flex-col gap-5 md:gap-6 w-full min-h-screen">
                    {{ $slot }}
                </div>
            </div>
            @include('components.beranda.footer')
        </div>
        @include('components.dashboard.aside')
    </div>
</main>
