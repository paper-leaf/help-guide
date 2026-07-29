<?php

namespace PaperLeaf\HelpGuide\Models;

use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PaperLeaf\HelpGuide\Models\Enums\Status;
use PaperLeaf\HelpGuide\Pages\ViewHelpPage;

class HelpPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'help_guide_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'is_featured',
        'description',
        'topic_id',
        'icon',
        'content',
        'viewable_by_role',
        'nav_order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Create the URL to this page
     */
    protected function pageUrl(): Attribute
    {
        $topic = optional($this->topic)->slug;
        $topic = (isset($topic)) ? $topic : 'uncategorized';

        $url = ViewHelpPage::getUrl([
            'record' => $this->slug,
            'topic' => $topic,
        ]);

        return Attribute::make(
            get: fn () => $url,
        );
    }

    /**
     * Create the verified (safe) icon for display
     */
    protected function safeIcon(): Attribute
    {
        // Make sure the page icon exists before using it
        $default_icon = 'heroicon-o-information-circle';

        try {
            $icon = Str::start($this->icon, 'heroicon-');
            $icon_exists = app(IconFactory::class)->svg($icon) !== null;
            $icon = ($icon_exists) ? $icon : $default_icon;
        } catch (\Exception $e) {
            $icon = $default_icon;
        }

        return Attribute::make(
            get: fn () => $icon,
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    /**
     * Get the topic this page belongs to
     *
     * @return Topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
