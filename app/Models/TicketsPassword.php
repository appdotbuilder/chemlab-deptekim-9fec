<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TicketsPassword
 *
 * @property int $id
 * @property string $ticket_code
 * @property int|null $user_id
 * @property string $status
 * @property int|null $handler_id
 * @property string $reason
 * @property string|null $admin_notes
 * @property string|null $temporary_password
 * @property \Illuminate\Support\Carbon|null $resolved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $handler
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereTicketCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereHandlerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereTemporaryPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereResolvedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketsPassword pending()
 * @method static \Database\Factories\TicketsPasswordFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TicketsPassword extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ticket_code',
        'user_id',
        'handler_id',
        'reason',
        'status',
        'admin_notes',
        'temporary_password',
        'resolved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var list<string>
     */
    protected $hidden = [
        'temporary_password',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets_passwords';

    /**
     * Get the user that created this ticket.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that handles this ticket.
     */
    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handler_id');
    }

    /**
     * Scope a query to only include pending tickets.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Generate a unique ticket code using PWD-YYYYMMDD-XXXX format.
     *
     * @return string
     */
    public static function generateTicketCode(): string
    {
        $date = now()->format('Ymd');
        $prefix = 'PWD-' . $date . '-';
        
        do {
            $randomNumber = str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            $ticketCode = $prefix . $randomNumber;
        } while (self::where('ticket_code', $ticketCode)->exists());
        
        return $ticketCode;
    }
}