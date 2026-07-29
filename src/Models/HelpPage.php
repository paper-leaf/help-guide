<?php

namespace PaperLeaf\HelpGuide\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use PaperLeaf\HelpGuide\Pages\ViewHelpPage;

use PaperLeaf\HelpGuide\Models\Enums\Status;

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
