<?php

namespace PaperLeaf\HelpGuide\Pages;

use Illuminate\Support\Str;
use Livewire\Attributes\Computed;

use Filament\Pages\Page;

use PaperLeaf\HelpGuide\Models\HelpPage;
use PaperLeaf\HelpGuide\Models\Topic;
use PaperLeaf\HelpGuide\Pages\WelcomePage;

class ViewHelpPage extends Page
{
    protected string $view = 'help-guide::pages.help-page';

    public $headings_on_page = [];

    public function getTitle(): string
    {
        return $this->record->title;
    }

    public function getSubheading(): ?string
    {
        return $this->record->description;
    }

    protected static ?string $slug = 'pages/{topic}/{record}';

    public HelpPage $record;

    public $topic;

    // These pages are registered dynamically in the HelpGuidePanelProvider
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount($record, $topic): void
    {
        $this->topic = Topic::where('slug', $topic)->first();
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [
            WelcomePage::getUrl() => 'Home',
        ];

        if(isset($this->topic)) {
            $breadcrumbs[$this->topic->page_url] = $this->topic->title;
        }

        $breadcrumbs[''] = $this->record->title;

        return $breadcrumbs;

        return [
            
            route('filament.admin.pages.dashboard') => 'Dashboard',
            // Add your current or intermediate custom paths here
            '' => $this->record->title,
        ];
    }

    #[Computed]
    public function formattedContent()
    {
        return $this->parseHtml($this->record->content);
    }

    /**
     * Parse page content to make all headings linked
     * Save the list of headings for use in an on-page nav
     * 
     * @param string $html
     * @return string $html
     */
    public function parseHtml($html)
    {
        // 1. Initialize DOMDocument and suppress parsing warnings
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        
        // Load HTML using UTF-8 encoding configuration
        $dom->loadHTML(
            '<?xml encoding="utf-8" ?>' . $html, 
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        // 1. Use XPath to select all headings in the exact order they appear
        $xpath = new \DOMXPath($dom);
        $heading_nodes = $xpath->query('//h2 | //h3');

        // 2. Setup the tracking stack for nesting
        $nav_tree = [];
        $current_h2_index = null;

        // The stack holds references to the 'children' arrays at each heading level
        $stack = [
            0 => &$nav_tree // Level 0 represents the root of our tree
        ];

        foreach ($heading_nodes as $heading) {
            $text = trim($heading->textContent);
            if ($text === '') continue;

            // Determine numerical level (e.g., "h2" -> 2)
            $current_level = (int)substr($heading->tagName, 1);

            // 3. Generate uniform slug and inject the link into DOM
            $slug = Str::slug($text);
            $heading_url = "#{$slug}";

            $heading->setAttribute('id', $slug);

            // 3. Construct the clean node item
            $node = [
                'text' => $text,
                'url' => $heading_url,
                'children' => []
            ];

            // 4. Directly sort the element by tag type
            if ($heading->tagName === 'h2') {
                $nav_tree[] = $node;
                $current_h2_index = count($nav_tree) - 1; // Update index to point to this new H2
            } 
            elseif ($heading->tagName === 'h3') {
                if ($current_h2_index !== null) {
                    // Nest directly under the active H2 parent
                    $nav_tree[$current_h2_index]['children'][] = $node;
                } else {
                    // Orphan H3 found before any H2 container; drop it at the root
                    $nav_tree[] = $node;
                }
            }
        }

        // Save the stack of headings to display in the on-page nav
        $this->headings_on_page = $nav_tree;

        return $dom->saveHTML();
    }
}
