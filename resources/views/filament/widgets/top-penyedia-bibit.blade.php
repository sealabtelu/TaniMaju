<x-filament-widgets::widget class="h-full"> <!-- Removes padding and margin from widget -->
    <x-filament::section class="h-full flex flex-col"> <!-- Removes padding and margin from section -->
        <header class="fi-section-header flex flex-col gap-3 mb-4 p-0">
            <div class="flex items-center gap-3">
                <div class="grid flex-1 gap-y-1">
                    <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white widget-title">
                        {{ $heading }}
                    </h3>
                </div>
            </div>
        </header>
        <div class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10">
            <div class="fi-section-content overflow-auto py-4">
                <ul class="list-none px-0">
                    @foreach ($penyediaBibit as $penyedia)
                        <li class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <span class="colored-bullet" style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: {{ $loop->index % 2 == 0 ? '#4CAF50' : '#FF5722' }}; margin-right: 8px;"></span>
                                <span class="font-medium">{{ $penyedia['nama_penyedia'] }}</span>
                            </div>
                            <span class="font-medium">{{ $penyedia['nama_tanaman'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
