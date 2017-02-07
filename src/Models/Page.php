<?php namespace Gbrock\Pages\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Gbrock\Pages\Traits\Domainable;
use Gbrock\Pages\Traits\Excerptable;
use Gbrock\Pages\Traits\Publishable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {

    use HasSlug,
        SoftDeletes,
        Publishable,
        Domainable,
        Excerptable;

    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'slug', 'content', 'public', 'public_before', 'public_after'];

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'public' => 'boolean',
    ];

    protected $dates = [
        'public_before',
        'public_after',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Limit a query to a specific "domain", or folder structure.
     *
     * @param $query
     * @param string $domain
     * @return mixed
     */
    public function scopeSlugDomain($query, $domain)
    {
        $domainQuery = str_replace("*", '%', $domain);

        return $query->where('slug', 'like', $domainQuery);
    }

    /**
     * Render the page using the default view.
     *
     * @param bool $viewFile
     * @return \Illuminate\View\View
     */
    public function render($viewFile = false)
    {
        $view = $viewFile ?: $this->getView();

        return view($view, [
            'page' => $this,
        ]);
    }

    private function getView()
    {
        return isset($this->view) ? $this->view : config('pages.view');
    }
}
