<?php

namespace PaperLeaf\HelpGuide\Models;

use Illuminate\Database\Eloquent\Model;
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
    ];

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
