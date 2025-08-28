<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $nim
 * @property string|null $phone
 * @property string $status
 * @property string|null $verification_notes
 * @property int|null $lab_id
 * @property bool $must_change_password
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Lab|null $lab
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Loan> $loans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PasswordHelpTicket> $passwordHelpTickets
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TicketsPassword> $ticketsPasswords

 * 
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User approved()
 * @method static \Illuminate\Database\Eloquent\Builder|User pending()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'phone',
        'status',
        'verification_notes',
        'lab_id',
        'must_change_password',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'must_change_password' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Get the lab that the user belongs to.
     */
    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Get all loans for this user.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'borrower_id');
    }

    /**
     * Get all password help tickets for this user.
     */
    public function passwordHelpTickets(): HasMany
    {
        return $this->hasMany(PasswordHelpTicket::class);
    }

    /**
     * Get all tickets password for this user.
     */
    public function ticketsPasswords(): HasMany
    {
        return $this->hasMany(TicketsPassword::class);
    }

    /**
     * Get all tickets password handled by this user.
     */
    public function handledTicketsPasswords(): HasMany
    {
        return $this->hasMany(TicketsPassword::class, 'handler_id');
    }

    /**
     * Scope a query to only include approved users.
     */
    public function scopeApproved($query)
    {
        return $query->whereIn('status', ['approved', 'active']);
    }

    /**
     * Scope a query to only include pending users.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Get user role (simplified without Spatie package for now).
     */
    public function getRole(): string
    {
        // This will be implemented with proper role system later
        return 'user';
    }
}