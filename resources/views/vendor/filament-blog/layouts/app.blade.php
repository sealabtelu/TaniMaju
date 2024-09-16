<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/logo-tanimaju.png')}}" type="image/x-icon" />
    <title>TaniMaju</title>
    {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
    {!! $setting?->google_console_code !!}
    {!! $setting?->google_analytic_code !!}
    {!! $setting?->google_adsense_code !!}
    @vite('resources/css/app.css')

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                container: {
                    padding: '1rem',
                    screen: {
                        '2xl': '1200px'
                    }
                },
                extend: {
                    colors: {
                        'primary': {
                            DEFAULT: '#FDAE4B',
                            50: '#fff9f5',
                            100: '#FFF7EC',
                            200: '#FEE4C4',
                            300: '#FED29C',
                            400: '#FDC073',
                            500: '#FDAE4B',
                            600: '#FC9514',
                            700: '#D57802',
                            800: '#9E5902',
                            900: '#663901',
                            950: '#4B2A01'
                        },
                        'rum': {
                            DEFAULT: '#6C6489',
                            50: '#FFFFFF',
                            100: '#FFFFFF',
                            200: '#F0EFF3',
                            300: '#D9D7E2',
                            400: '#C3C0D1',
                            500: '#ADA8BF',
                            600: '#9790AE',
                            700: '#81799D',
                            800: '#6C6489',
                            900: '#524C69',
                            950: '#464058'
                        },
                        'cornsilk': '#FEFAE0',
                        'sage': '#C0C78C',
                        'olivine': '#A6B37D',
                        'camel': '#B99470',
                        'eerie-black': '#181818'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: "Poppins", serif;
            font-weight: 400;
            font-style: normal;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        /* Responsive styles */
        @media (max-width: 640px) {
            footer {
                padding: 1rem;
            }
            .px-16 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
    <style>
        /* Blog Posts */
        article h1 {
            line-height: 1.2;
            font-size: 1.75rem;
            color: #424242;
            font-weight: 900;
            padding-bottom: 20px;
        }

        article h2 {
            line-height: 1.2;
            font-size: 1.25rem;
            color: #424242;
            font-weight: 800;
            padding-bottom: 10px;
        }

        article h3 {
            line-height: 1.2;
            font-size: 1.125rem;
            color: #424242;
            font-weight: 700;
            padding-bottom: 10px;
        }

        article h4 {
            line-height: 1.2;
            font-size: 1rem;
            color: #424242;
            font-weight: 600;
            padding-bottom: 10px;
        }

        article p {
            line-height: 1.75;
            letter-spacing: .2px;
            font-size: 0.875rem;
            color: #424242;
            font-weight: 400;
            margin-bottom: 1rem;
        }

        article ul {
            line-height: 1.7;
            padding-bottom: 5px;
        }

        article table {
            margin-top: 2rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            width: 100%;
        }

        article table,
        article table td,
        article table th {
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        /* share this */
        .sharethis-inline-share-buttons {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .sharethis-inline-share-buttons .st-btn {
            width: 50px !important;
            height: 50px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            margin-bottom: 10px !important;
            border-radius: 50px !important;
            margin-right: 0 !important
        }

        .sharethis-inline-share-buttons .st-btn img {
            top: 0 !important
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen">
        <x-blog-header title="{{ $setting?->title }}" logo="{{ $setting?->logoImage }}" />
        <main>{{ $slot }}</main>

        <footer class="bg-olivine flex flex-col self-stretch px-4 md:px-16 gap-4 md:gap-6 text-cornsilk py-6">
            <div class="flex flex-col md:flex-row md:justify-between">
                <div class="flex flex-col items-center md:items-start justify-center text-sm font-medium h-full mb-4 md:mb-0">
                    <div class="relative overflow-hidden font-medium rounded-2xl bg-sage px-6 py-4">
                        <div class="mb-1 pb-2 text-xl font-semibold">Address</div>
                        <div class="flex flex-inline mb-6">
                            <x-fluentui-location-16 class="h-auto w-5 mr-2" />
                            <span>Desa Sukamaju, Jawa Barat, Indonesia</span>
                        </div>
                        <div class="flex flex-row mt-2 gap-4">
                            <img src="{{ asset('../assets/logo-desasukamaju.png') }}" class="w-14" alt="Logo Desa Sukamaju">
                            <img src="{{ asset('../assets/logo-sea.png') }}" class="h-14 w-18" alt="Logo SEA Laboratory">
                        </div>
                        <i class="bi bi-envelope pointer-events-none absolute -right-10 -top-20 text-[9rem] opacity-10"></i>
                    </div>
                </div>
                <div class="flex flex-col md:flex-col grid gap-3 py-3 text-sm font-medium">
                    <h4 class="text-xl font-semibold">Contact</h4>
                    <div class="flex flex-row">
                        <x-heroicon-s-phone class="h-auto w-5 mr-2" />
                        <span>+6285176860621</span>
                    </div>
                    <div class="flex flex-row">
                        <x-ionicon-mail class="h-auto w-5 mr-2"/>
                        <span>sealaboratory@365.telkomuniversity.ac.id</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-2 border-sage/50"></div>
            <div class="flex items-center justify-center">
                <span class="text-xs">© SEA LABORATORY 2024</span>
            </div>
        </footer>
        <div class="fixed bottom-0 left-0 z-50 h-20 w-full border-t border-gray-200 bg-white md:hidden">
            <div class="mx-auto grid h-full w-full grid-cols-2 justify-center font-medium">
                <a href="{{ route('filamentblog.post.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 w-6" viewBox="0 0 256 256">
                        <path fill="currentColor" d="m217.47 105.24l-80-75.5l-.09-.08a13.94 13.94 0 0 0-18.83 0l-.09.08l-80 75.5A14 14 0 0 0 34 115.55V208a14 14 0 0 0 14 14h48a14 14 0 0 0 14-14v-48a2 2 0 0 1 2-2h32a2 2 0 0 1 2 2v48a14 14 0 0 0 14 14h48a14 14 0 0 0 14-14v-92.45a14 14 0 0 0-4.53-10.31M210 208a2 2 0 0 1-2 2h-48a2 2 0 0 1-2-2v-48a14 14 0 0 0-14-14h-32a14 14 0 0 0-14 14v48a2 2 0 0 1-2 2H48a2 2 0 0 1-2-2v-92.45a2 2 0 0 1 .65-1.48l.09-.08l79.94-75.48a2 2 0 0 1 2.63 0L209.26 114l.08.08a2 2 0 0 1 .66 1.48Z" />
                    </svg>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600 dark:text-gray-400">Home</span>
                </a>
                <a href="{{ route('filamentblog.post.all') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 w-6" viewBox="0 0 256 256">
                        <path fill="currentColor" d="M216 40H40a16 16 0 0 0-16 16v160a8 8 0 0 0 11.58 7.15L64 208.94l28.42 14.21a8 8 0 0 0 7.16 0L128 208.94l28.42 14.21a8 8 0 0 0 7.16 0L192 208.94l28.42 14.21A8 8 0 0 0 232 216V56a16 16 0 0 0-16-16m0 163.06l-20.42-10.22a8 8 0 0 0-7.16 0L160 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L96 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L40 203.06V56h176ZM136 112a8 8 0 0 1 8-8h48a8 8 0 0 1 0 16h-48a8 8 0 0 1-8-8m0 32a8 8 0 0 1 8-8h48a8 8 0 0 1 0 16h-48a8 8 0 0 1-8-8m-72 24h48a8 8 0 0 0 8-8V96a8 8 0 0 0-8-8H64a8 8 0 0 0-8 8v64a8 8 0 0 0 8 8m8-64h32v48H72Z" />
                    </svg>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600 dark:text-gray-400">All Posts</span>
                </a>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("comment-box").submit();
        }
    </script>

</html>
