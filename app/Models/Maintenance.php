<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Maintenance
 *
 * @property int $id
 * @property int $equipment_id
 * @property int|null $performed_by
 * @property string $type
 * @property string $description
 * @property \Illuminate\Support\Carbon $scheduled_date
 * @property \Illuminate\Support\Carbon|null $completed_date
 * @property string $status
 * @property string|null $notes
 * @property float|null $cost
 * @property string|null $vendor
 * @property array|null $documents
 * @property \Illuminate\Support\Carbon|null $next_maintenance_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Equipment $equipment
 * @property-read \App\Models\User|null $performer
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance scheduled()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance completed()

 * 
 * @mixin \Eloquent
 */
class Maintenance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'equipment_id',
        'performed_by',
        'type',
        'description',
        'scheduled_date',
        'completed_date',
        'status',
        'notes',
        'cost',
        'vendor',
        'documents',
        'next_maintenance_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_date' => 'datetime',
        'completed_date' => 'datetime',
        'next_maintenance_date' => 'datetime',
        'documents' => 'array',
        'cost' => 'decimal:2',
    ];

    /**
     * Get the equipment being maintained.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the user who performed the maintenance.
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    /**
     * Scope a query to only include scheduled maintenance.
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope a query to only include completed maintenance.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}