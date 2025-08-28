<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Lab
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $location
 * @property int $capacity
 * @property array|null $operational_hours
 * @property string|null $description
 * @property string|null $contact_email
 * @property string|null $contact_phone
 * @property array|null $gallery_images
 * @property string|null $sop_document_path
 * @property array|null $sds_links
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Equipment> $equipment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \App\Models\User|null $headOfLab
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $laborans
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Lab newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lab newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lab query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lab active()
 * @method static \Database\Factories\LabFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Lab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'location',
        'capacity',
        'operational_hours',
        'description',
        'contact_email',
        'contact_phone',
        'gallery_images',
        'sop_document_path',
        'sds_links',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'operational_hours' => 'array',
        'gallery_images' => 'array',
        'sds_links' => 'array',
        'is_active' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Get all equipment in this lab.
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Get all users associated with this lab.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the head of lab.
     */
    public function headOfLab()
    {
        // Will be implemented with proper role system
        return $this->users()->where('status', 'active')->first();
    }

    /**
     * Get all laborans for this lab.
     */
    public function laborans()
    {
        // Will be implemented with proper role system  
        return $this->users()->where('status', 'active');
    }

    /**
     * Scope a query to only include active labs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}