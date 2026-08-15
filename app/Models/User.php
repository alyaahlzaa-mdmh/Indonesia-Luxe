<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'title',
        'date_of_birth',
        'country',
        'email',
        'avatar',
        'phone',
        'role',
        'luxe_points',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
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
            'date_of_birth' => 'date',
            'password' => 'hashed',
            'role' => UserRole::class,
            'luxe_points' => 'integer',
        ];
    }

    public function scopeRole($query, string|UserRole $role)
    {
        return $query->where('role', $role instanceof UserRole ? $role->value : $role);
    }

    public function hasAvatar(): bool
    {
        return $this->avatar !== null;
    }

    /**
     * Get the user's initials.
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(1)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function getAvatarUrl(): string
    {
        return $this->avatar ? asset('storage/'.$this->avatar) : asset('images/avatar.jpg');
    }

    public function vendorProfile(): HasOne
    {
        return $this->hasOne(VendorProfile::class);
    }

    public function tourPackages(): HasMany
    {
        return $this->hasMany(TourPackage::class, 'vendor_id');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function submittedPaymentSubmissions(): HasMany
    {
        return $this->hasMany(PaymentSubmission::class, 'submitted_by_user_id');
    }

    public function validatedPaymentSubmissions(): HasMany
    {
        return $this->hasMany(PaymentSubmission::class, 'validated_by_user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isVendor(): bool
    {
        return $this->role === UserRole::Vendor;
    }

    public function isCustomer(): bool
    {
        return $this->role === UserRole::Customer;
    }

    public function isVendorApproved(): bool
    {
        return $this->isVendor()
            && $this->vendorProfile !== null
            && $this->vendorProfile->status === VendorStatus::Approved;
    }

    public function vendorBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'vendor_id');
    }

    public function promos(): HasMany
    {
        return $this->hasMany(Promo::class, 'vendor_id');
    }

    public function giftCards(): HasMany
    {
        return $this->hasMany(GiftCard::class, 'vendor_id');
    }

    public function vendorWallet(): HasOne
    {
        return $this->hasOne(VendorWallet::class);
    }

    public function wishlistedTourPackages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TourPackage::class, 'wishlists')->withTimestamps();
    }
}
