<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-row gap-3 md:gap-5">
            <div class="bg-primary-500 p-3 h-10 w-10 min-w-10 flex items-center justify-center rounded-full">
                <x-filament::icon
                    icon="heroicon-o-book-open"
                    class="w-6 h-6 min-w-6 text-white"
                />
            </div>

            <div class="">
                <p class="!text-sm">
                    <b>Need a hand?</b> 
                    Browse the Help Guide for answers and helpful tips.
                </p>

                <x-filament::link 
                    size="sm" 
                    :href="$this->guide_url"
                    target="_blank"
                    icon="heroicon-m-arrow-top-right-on-square"
                    icon-position="after"
                    class="mt-2"
                >
                    View help guide
                </x-filament::link>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
