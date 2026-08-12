<?php

namespace PaperLeaf\HelpGuide\Models;

use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PaperLeaf\HelpGuide\Models\Enums\Status;
use PaperLeaf\HelpGuide\Pages\ViewHelpPage;
use PaperLeaf\HelpGuide\Services\PermissionsService;

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
        'required_permissions',
        'nav_order',
        'related_pages',
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
            'required_permissions' => 'array',
            'related_pages' => 'array',
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

    /**
     * Check if this page is published
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->status == Status::PUBLISHED;
    }

    /**
     * Check if this page can be viewed by the current user
     *
     * @return bool
     */
    public function canView()
    {
        // Check if there's any permissions even saved on this page
        if (! isset($this->required_permissions) || is_array($this->required_permissions) && count($this->required_permissions) == 0) {
            return true;
        }

        // Evaluate the permissions
        $can_view = new PermissionsService()->hasAnyPermissions($this->required_permissions);

        return $can_view;
    }
}
