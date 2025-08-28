<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Equipment
 *
 * @property int $id
 * @property string $name
 * @property string $asset_code
 * @property int $category_id
 * @property int $lab_id
 * @property string|null $description
 * @property array|null $technical_specifications
 * @property string|null $manufacturer
 * @property string|null $model
 * @property string|null $serial_number
 * @property int|null $year_acquired
 * @property string $condition
 * @property string $availability_status
 * @property array|null $calibration_schedule
 * @property string|null $risk_assessment
 * @property array|null $required_ppe
 * @property array|null $sds_links
 * @property array|null $images
 * @property string|null $qr_code_path
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Lab $lab
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Loan> $loans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Maintenance> $maintenances
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment available()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipment active()
 * @method static \Database\Factories\EquipmentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Equipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'asset_code',
        'category_id',
        'lab_id',
        'description',
        'technical_specifications',
        'manufacturer',
        'model',
        'serial_number',
        'year_acquired',
        'condition',
        'availability_status',
        'calibration_schedule',
        'risk_assessment',
        'required_ppe',
        'sds_links',
        'images',
        'qr_code_path',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'technical_specifications' => 'array',
        'calibration_schedule' => 'array',
        'required_ppe' => 'array',
        'sds_links' => 'array',
        'images' => 'array',
        'is_active' => 'boolean',
        'year_acquired' => 'integer',
    ];

    /**
     * Get the category that owns the equipment.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the lab that owns the equipment.
     */
    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Get all loans for this equipment.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get all maintenance records for this equipment.
     */
    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    /**
     * Scope a query to only include available equipment.
     */
    public function scopeAvailable($query)
    {
        return $query->where('availability_status', 'available');
    }

    /**
     * Scope a query to only include active equipment.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if equipment is currently available for borrowing.
     */
    public function isAvailableForLoan(): bool
    {
        return $this->is_active && 
               $this->availability_status === 'available' && 
               $this->condition !== 'needs_repair';
    }
}