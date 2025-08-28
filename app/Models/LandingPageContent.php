<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LandingPageContent
 *
 * @property int $id
 * @property string $hero_title
 * @property string|null $hero_subtitle
 * @property string|null $hero_image_path
 * @property string|null $description
 * @property string|null $usage_guide
 * @property string|null $demo_content
 * @property string|null $faqs
 * @property string|null $contact_information
 * @property string|null $user_guide_link
 * @property bool $is_active
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User|null $updater
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|LandingPageContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LandingPageContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LandingPageContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|LandingPageContent active()
 * @method static \Database\Factories\LandingPageContentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class LandingPageContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_image_path',
        'description',
        'usage_guide',
        'demo_content',
        'faqs',
        'contact_information',
        'user_guide_link',
        'is_active',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'faqs' => 'array',
    ];

    /**
     * Get the user who last updated the content.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope a query to only include active content.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the active landing page content.
     */
    public static function getActive()
    {
        return static::active()->first();
    }
}