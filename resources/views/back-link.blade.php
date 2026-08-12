<x-filament::link 
    href="{{ url(\Filament\Facades\Filament::getDefaultPanel()->getPath()) }}"
    icon="heroicon-m-arrow-right"
    icon-position="after"
>
    Back to {{ \Filament\Facades\Filament::getDefaultPanel()->getBrandName() }}
</x-filament::link>