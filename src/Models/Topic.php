<?php

namespace PaperLeaf\HelpGuide\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use PaperLeaf\HelpGuide\Pages\TopicArchivePage;

class Topic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'help_guide_topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
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
        $url = TopicArchivePage::getUrl([
            'record' => $this->slug,
        ]);

        return Attribute::make(
            get: fn () => $url,
        );
    }

    /**
     * Get the pages under this topic
     *
     * @return Collection
     */
    public function pages()
    {
        return $this->hasMany(HelpPage::class);
    }
}
