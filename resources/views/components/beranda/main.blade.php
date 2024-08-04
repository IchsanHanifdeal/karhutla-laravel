<!DOCTYPE html>
<html lang="en" data-theme="lemonade">

@include('components.beranda.head')

<body class="flex flex-col mx-auto min-h-dvh {{ $full ?? 'max-w-screen-2xl' }}">
    @include('components.beranda.navbar')
    <main class="{{ $class ?? 'p-4' }}">
        {{ $slot }}
    </main>
    @if (!request()->routeIs('login'))
        @include('components.beranda.footer')
    @endif
</body>

</html>
