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
        @include('help-guide::partials.page-cards', ['pages' => $this->featured_articles])
    @endif
</x-filament-panels::page>