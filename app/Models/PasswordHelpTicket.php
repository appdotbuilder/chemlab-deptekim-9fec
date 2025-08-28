<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * App\Models\PasswordHelpTicket
 *
 * @property int $id
 * @property string $ticket_code
 * @property int $user_id
 * @property int|null $handled_by
 * @property string $reason
 * @property string $status
 * @property string|null $admin_notes
 * @property string|null $temporary_password
 * @property \Illuminate\Support\Carbon|null $resolved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $handler
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHelpTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHelpTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHelpTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHelpTicket pending()

 * 
 * @mixin \Eloquent
 */
class PasswordHelpTicket extends Model
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
        'handled_by',
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
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'temporary_password',
    ];

    /**
     * Get the user who requested the password help.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin/laboran who handled the ticket.
     */
    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    /**
     * Scope a query to only include pending tickets.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Generate a unique ticket code.
     */
    public static function generateTicketCode(): string
    {
        $prefix = 'PWD';
        $date = Carbon::now()->format('Ymd');
        $sequence = static::whereDate('created_at', Carbon::today())->count() + 1;
        
        return sprintf('%s-%s-%04d', $prefix, $date, $sequence);
    }
}