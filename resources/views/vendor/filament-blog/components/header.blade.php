@props(['title' =>'TaniMaju', 'logo' => null] )
<header class="sticky top-0 z-[94035]">
    <div class="py-4 bg-white border-b">
        <div class="container mx-auto">
            <div class="flex justify-between gap-x-2">
                <div class="flex items-center gap-x-10">
                    <a href="{{config('filamentblog.route.home.url') ?? config('app.url')}}">
                        <strong x-show="showTaniMaju" class="text-2xl text-olivine mr-6">
                            {{ $title ?: 'TaniMaju' }}
                        </strong>
                    </a>
                    <div class="hidden gap-x-8 sm:flex">
                        <div class="relative group">
                            <button class="flex items-center justify-center font-semibold text-md hover:text-primary-600 gap-x-2">
                                <span>Artikel</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 9l-7 6l-7-6" />
                                </svg>
                            </button>
                            <div class="absolute right-1 group-hover:pointer-events-auto top-[calc(100%)] origin-left pt-2 opacity-0 pointer-events-none transition will-change-transform lg:left-[50%] lg:right-auto lg:translate-x-[-50%] group-hover:opacity-100">
                                <x-blog-header-category />
                            </div>
                        </div>
                        <a href="#tentang" class="font-semibold text-md hover:text-primary-600" onclick="event.preventDefault(); document.querySelector('#tentang').scrollIntoView({ behavior: 'smooth' });">
                            <span>Tentang</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center ml-auto gap-x-10">
                    <form action="{{ route('filamentblog.post.search') }}" method="GET">
                        <div class="relative">
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-5 h-5 -translate-y-1/2 pointer-events-none left-5 top-1/2 text-slate-500" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="11.5" cy="11.5" r="9.5" />
                                        <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                                    </g>
                                </svg>
                                <input placeholder="Search" type="text" name="query" value="{{ request()->get('query') }}" class="w-full px-6 py-3 pl-12 text-sm font-medium text-gray-800 placeholder-gray-400 border rounded-full outline-none bg-white/10 placeholder:text-slate-500 focus:ring-0" />
                            </div>
                            @error('query')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                    {{-- Hidden Features --}}
                    {{-- <div class="bg-olivine text-cornsilk font-semibold text-sm px-6 py-2 rounded">
                        <a href="/admin">Login Admin</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</header>