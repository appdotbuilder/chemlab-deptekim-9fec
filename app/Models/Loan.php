<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * App\Models\Loan
 *
 * @property int $id
 * @property string $loan_code
 * @property int $borrower_id
 * @property int $equipment_id
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon $requested_start_date
 * @property \Illuminate\Support\Carbon $requested_end_date
 * @property \Illuminate\Support\Carbon|null $actual_start_date
 * @property \Illuminate\Support\Carbon|null $actual_end_date
 * @property string $status
 * @property string|null $purpose
 * @property string|null $jsa_document_path
 * @property array|null $initial_condition_photos
 * @property array|null $final_condition_photos
 * @property array|null $initial_checklist
 * @property array|null $final_checklist
 * @property string|null $approval_notes
 * @property string|null $rejection_notes
 * @property string|null $return_notes
 * @property bool $is_overdue
 * @property int $overdue_days
 * @property bool $penalty_applied
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $borrower
 * @property-read \App\Models\Equipment $equipment
 * @property-read \App\Models\User|null $approver
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan pending()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan active()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan overdue()

 * 
 * @mixin \Eloquent
 */
class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'loan_code',
        'borrower_id',
        'equipment_id',
        'approved_by',
        'requested_start_date',
        'requested_end_date',
        'actual_start_date',
        'actual_end_date',
        'status',
        'purpose',
        'jsa_document_path',
        'initial_condition_photos',
        'final_condition_photos',
        'initial_checklist',
        'final_checklist',
        'approval_notes',
        'rejection_notes',
        'return_notes',
        'is_overdue',
        'overdue_days',
        'penalty_applied',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requested_start_date' => 'datetime',
        'requested_end_date' => 'datetime',
        'actual_start_date' => 'datetime',
        'actual_end_date' => 'datetime',
        'initial_condition_photos' => 'array',
        'final_condition_photos' => 'array',
        'initial_checklist' => 'array',
        'final_checklist' => 'array',
        'is_overdue' => 'boolean',
        'penalty_applied' => 'boolean',
        'overdue_days' => 'integer',
    ];

    /**
     * Get the user who borrowed the equipment.
     */
    public function borrower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    /**
     * Get the equipment being borrowed.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the user who approved the loan.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope a query to only include pending loans.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include active loans (approved or checked out).
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['approved', 'checked_out']);
    }

    /**
     * Scope a query to only include overdue loans.
     */
    public function scopeOverdue($query)
    {
        return $query->where('is_overdue', true);
    }

    /**
     * Check if the loan is currently overdue.
     */
    public function isOverdue(): bool
    {
        if ($this->status !== 'checked_out' || $this->actual_end_date) {
            return false;
        }

        return Carbon::now()->isAfter($this->requested_end_date);
    }

    /**
     * Calculate overdue days.
     */
    public function getOverdueDays(): int
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        return (int) Carbon::now()->diffInDays($this->requested_end_date);
    }

    /**
     * Generate a unique loan code.
     */
    public static function generateLoanCode(): string
    {
        $prefix = 'LOAN';
        $date = Carbon::now()->format('Ymd');
        $sequence = static::whereDate('created_at', Carbon::today())->count() + 1;
        
        return sprintf('%s-%s-%04d', $prefix, $date, $sequence);
    }
}