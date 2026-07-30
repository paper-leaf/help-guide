<x-filament-panels::page>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    <div class="col-span-2 wysiwyg-content">
        {!! $this->formatted_content !!}
    </div>

    <div class="col-span-1 relative">
        @if(count($this->headings_on_page) > 0)
            <div class="sticky top-[100px]">
                <b class="block text-xs mb-3 uppercase">On this page</b>
                <div class="flex flex-col gap-1 border-l pl-4">
                    @foreach($this->headings_on_page as $heading_2) 
                        <a href="{{ $heading_2['url'] }}" class="text-sm">
                            {{ $heading_2['text'] }}
                        </a>

                        @if(count($heading_2['children']) > 0)
                            <div class="flex flex-col gap-1 ml-4">
                                @foreach($heading_2['children'] as $heading_3)
                                    <a href="{{ $heading_3['url'] }}" class="text-sm">
                                        {{ $heading_3['text'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
  </div>

  @if($this->related_pages->count() > 0)
    <div class="">
        <h2 id="related-documentation">Related documentation</h2>

        @include('help-guide::partials.page-cards', ['pages' => $this->related_pages])
    </div>
  @endif

  <div class="border-t pt-3">
    <i class="text-xs">Last updated: {{ \Carbon\Carbon::parse($this->record->updated_at)->format('F j, Y') }}</i>
  </div>
</x-filament-panels::page>