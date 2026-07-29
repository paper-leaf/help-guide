<x-filament-panels::page>
    <div class="mb-6 flex flex-col items-center border-b pb-12">
        <h1 class="text-center !m-0 !mt-5 !mb-3">
            Welcome to the Help Guide
        </h1>

        <p class="text-center max-w-[60ch]">
            @if($this->featured_articles->count() > 0)
                Browse help articles and step-by-step guides to learn how to use the application's features and complete common tasks. Start with one of the featured articles below, or explore the full Help Guide by browsing topics in the sidebar.
            @else 
                Browse help articles and step-by-step guides to learn how to use the application's features and complete common tasks. Explore the full Help Guide by browsing topics in the sidebar.
            @endif
        </p>
    </div>

    @if($this->featured_articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($this->featured_articles as $page)
                <x-filament::section>
                    <div class="flex flex-col md:flex-row gap-3 md:gap-5">
                        <div class="bg-primary-500 p-3 h-10 w-10 min-w-10 flex items-center justify-center rounded-full">
                            <x-dynamic-component :component="$page->safe_icon" class="w-7 h-7 min-w-7" />
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
                                target="_blank"
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
    @endif
</x-filament-panels::page>