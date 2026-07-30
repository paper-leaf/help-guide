<?php

namespace PaperLeaf\HelpGuide\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Create the URL to this page
     */
    protected function pageUrl(): Attribute
    {
        // $topic = optional($this->topic)->slug;
        // $topic = (isset($topic)) ? $topic : 'uncategorized';

        // $url = ViewHelpPage::getUrl([
        //     'record' => $this->slug,
        //     'topic' => $topic,
        // ]);

        return Attribute::make(
            get: fn () => '/',
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
