<?php

namespace PaperLeaf\HelpGuide\Models;

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
    ];

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
