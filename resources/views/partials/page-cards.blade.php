@props([
    'pages' => collect([])
])

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($pages as $page)
        @if(!$page->canView()) 
            @continue
        @endif

        <x-filament::section>
            <div class="flex flex-col md:flex-row gap-3 md:gap-5">
                <div class="bg-primary-500 p-3 h-10 w-10 min-w-10 flex items-center justify-center rounded-full">
                    <x-dynamic-component :component="$page->icon" class="w-7 h-7 min-w-7" />
                </div>

                <div class="">
                    <b class="inline-block">{{ $page->title }}</b>
                    <p class="!text-sm">{!! $page->description !!}</p>
                </div>
            </div>

            <x-slot name="footer">
                <div class="w-full flex justify-end">
                    <x-filament::link 
                        size="sm" 
                        :href="$page->page_url"
                        icon="heroicon-m-arrow-right"
                        icon-position="after"
                    >
                        Read more
                    </x-filament::link>
                </div>
            </x-slot>
        </x-filament::section>
    @endforeach
</div>