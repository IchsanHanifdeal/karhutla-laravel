<x-beranda.main title="Login" class="p-0" full>
    <section class="min-h-screen flex items-stretch text-white ">
        <div
            class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center bg-[url('https://images.pexels.com/photos/2412711/pexels-photo-2412711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')]">
            <div class="absolute bg-[linear-gradient(180deg,transparent,rgba(0,0,0,1))] inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <p class="text-4xl leading-tight tracking-wide font-semibold max-w-lg">Monitoring Kebakaran Hutan yang
                    terjadi di sekitar anda.</p>
            </div>
            <div class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4">
                <span>
                    @include('components.beranda.brands')
                </span>
            </div>
        </div>
        <div class="lg:w-1/2 bg-[#c6ccc0] w-full flex items-center justify-center text-center md:px-16 px-0 z-0">
            <div
                class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center bg-[url('https://images.pexels.com/photos/2412711/pexels-photo-2412711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')]">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="my-6">
                    @include('components.beranda.brands', ['class' => '!text-3xl text-black'])
                </h1>
                <form action="{{ route('login') }}" method="POST" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    @csrf
                    <div class="pb-2 pt-4">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            placeholder="Masukkan email..."
                            class="input block w-full p-4 text-lg bg-warning-700 text-black">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-2 pt-4">
                        <input type="password" name="password" id="password" required
                            placeholder="Masukkan password..."
                            class="input block w-full p-4 text-lg bg-warning-700 text-black">
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pb-2 pt-4">
                        <button type="submit" class="btn w-full btn-warning">Masuk</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</x-beranda.main>
