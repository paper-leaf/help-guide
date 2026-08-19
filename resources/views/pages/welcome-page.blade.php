<x-filament-panels::page>
    <div class="mb-6 flex flex-col items-center border-b pb-12">
        <h1 class="text-center !m-0 !mt-5 !mb-3">
            Welcome to the Help Guide
        </h1>

        <p class="text-center max-w-[60ch]">
            Find articles and guides for common tasks to learn how to use the application.</br>
            @if($this->featured_articles->count() > 0)
                Start with a featured guide below, or explore the full Help Guide by browsing topics in the sidebar.
            @else 
                Explore the full Help Guide by browsing topics in the sidebar.
            @endif
        </p>
    </div>

    @if($this->featured_articles->count() > 0)
        @include('help-guide::partials.page-cards', ['pages' => $this->featured_articles])
    @endif
</x-filament-panels::page>