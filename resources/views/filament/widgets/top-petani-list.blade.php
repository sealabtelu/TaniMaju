<x-filament-widgets::widget class="h-full"> <!-- Removes padding and margin from widget -->
    <x-filament::section class="h-full flex flex-col"> <!-- Removes padding and margin from section -->
        <header class="fi-section-header flex flex-col gap-3 mb-4 p-0"> <!-- Removes padding from header -->
            <div class="flex items-center gap-3 p-0">
                <div class="grid flex-1 gap-y-1 p-0">
                    <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white widget-title">
                        {{ $heading }}
                    </h3>
                </div>
            </div>
        </header>

        <!-- Make the content fill the remaining space -->
        <div class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10 flex-grow p-0 m-0"> <!-- No padding/margin -->
            <div class="fi-section-content overflow-auto py-4 p-0 m-0"> <!-- No padding/margin on list container -->
                <ul class="list-none p-0 m-0"> <!-- Removes padding/margin from ul -->
                    @foreach ($petanis as $petani)
                        <li class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <span class="colored-bullet" style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: {{ $loop->index % 2 == 0 ? '#4CAF50' : '#FF5722' }}; margin-right: 8px;"></span>
                                <span class="font-medium">{{ $petani['nama_petani'] }}</span>
                            </div>
                            <span class="font-medium">{{ $petani['total_panen'] }} kg</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
