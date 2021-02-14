<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Post extends Model {

    use HasFactory, HasTranslations, HasTranslatableSlug, SearchableTrait;

    protected $guarded = [];

    public $translatable = ['title', 'slug', 'body'];

    protected $searchable = [
        'columns' => [
            'title' => 10,
            'body'  => 10,
        ]
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;

        if ($this->hasCustomSlugBeenUsed() && ! empty($this->$slugField)) {
            return $this->$slugField;
        }

        return MySlugHelper::slug($this->getSlugSourceString());
    }

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
