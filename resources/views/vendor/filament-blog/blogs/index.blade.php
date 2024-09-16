<x-blog-layout>
    <section class="py-40 w-full px-40 bg-[url({{asset('assets/bg.jpg')}})] bg-no-repeat bg-cover">
                <h1 class="font-poppins font-bold text-4xl text-olivine mb-4 home">TaniMaju</h1>
                <p class="max-w-5xl text-cornsilk text-xl font-light">
                    Website manajemen hasil panen yang dirancang untuk mendukung para petani di Desa Sukamaju, Bandung, Jawa Barat
                    sebagai solusi lengkap dalam mengelola data pertanian dengan lebih efisien dan akurat.
                </p>
    </section>
    <!-- Curved Divider -->
    <div class="hidden md:block w-full h-2 relative" id="divider">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 left-0 w-full">
                <path
                    d="M0 43.9999C106.667 43.9999 213.333 7.99994 320 7.99994C426.667 7.99994 533.333 43.9999 640 43.9999C746.667 43.9999 853.333 7.99994 960 7.99994C1066.67 7.99994 1173.33 43.9999 1280 43.9999C1386.67 43.9999 1440 19.0266 1440 9.01329V100H0V43.9999Z"
                    class="fill-current text-white">
                </path>
            </svg>
        </div>
    <section class="pb-8 pt-8">
        <div class="container mx-auto p-8 rounded-xl shadow">
            <h2 class="font-semibold text-2xl text-olivine mb-6" id="article">Artikel Terkini</h2>
            @if(count($posts))
                <div class="flex flex-row justify-between gap-8">
                    @foreach ($posts->take(2) as $post)
                        <x-blog-card :post="$post" class="flex-1 min-w-[300px]" />
                    @endforeach
                </div>
                <div class="flex justify-center pt-20">
                    <a href="{{ route('filamentblog.post.all') }}" class="flex items-center justify-center md:gap-x-5 rounded-full bg-slate-100 px-20 py-4 text-sm font-semibold transition-all duration-300 hover:bg-slate-200">
                        <span>Lihat semua artikel</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6m0 0H9m9 0v9" />
                        </svg>
                    </a>
                </div>
            @else
                <div class="flex justify-center">
                    <p class="text-2xl font-semibold text-gray-300">No posts found</p>
                </div>
            @endif
        </div>
    </section>
    <section class="pb-16 pt-8" id="tentang">
        <div class="flex items-center px-16">
            <div class="border-t border-4 border-sage flex-grow"></div>
            <h2 class="px-10 font-poppins font-bold text-4xl text-olivine mb-4">Tentang</h2>
            <div class="border-t border-4 border-sage flex-grow"></div>
        </div>
        <div class="flex flex-col px-16 justify-center items-center">
            <p class="max-w text-eerie-black text-lg font-light text-center">
                <strong class="font-bold text-olivine">TaniMaju</strong> adalah aplikasi manajemen hasil panen yang dirancang untuk meningkatkan efisiensi dan
                produktivitas pertanian di Desa Sukamaju, Bandung, Jawa Barat. Nama <strong class="font-bold text-olivine">TaniMaju</strong> mencerminkan kombinasi
                dari kata <strong class="font-bold italic">"Tani"</strong> yang berarti pertanian dan <strong class="font-bold italic">"Maju"</strong> yang berarti kemajuan, mencerminkan tujuan kami
                untuk memajukan sektor pertanian di Desa Sukamaju melalui teknologi. 
            </p>
            <div class="flex items-start self-stretch justify-between items-centermy-10 gap-x-4 md:gap-x-8">
                @foreach ([
                    // ['name' => 'Sef Sofa Maulanaja', 'role' => 'Staff Team', 'image' => '../assets/SEF.png'],
                    ['name' => 'Panji Christopher', 'role' => 'Staff Team', 'image' => '../assets/YNA.png'],
                    ['name' => 'Axel David', 'role' => 'Project Team Leader', 'image' => '../assets/AXL.png'],
                    ['name' => 'Yogas Herlambang', 'role' => 'Staff Team', 'image' => '../assets/YOG.png'],
                ] as $member)
                    <div class="flex flex-col items-center text-center py-8">
                        <img class="max-w-32 md:max-w-44" src="{{ $member['image'] }}" alt="">
                        <span class="font-bold text-lg text-olivine mt-4">{{ $member['name'] }}</span>
                        <span class="font-light text-sm text-olivine italic">{{ $member['role'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-blog-layout>
