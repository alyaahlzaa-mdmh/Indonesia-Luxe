<?php

namespace App\Models;

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourPackage extends Model
{
    /** @use HasFactory<\Database\Factories\TourPackageFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'vendor_id',
        'tour_category_id',
        'status',
        'type',
        'title',
        'slug',
        'description',
        'meeting_point',
        'duration',
        'max_participants',
        'price_per_person',
        'start_date',
        'end_date',
        'cover_image_path',
        'highlights',
        'included',
        'extra_photos',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => PackageStatus::class,
            'type' => PackageType::class,
            'price_per_person' => 'decimal:2',
            'is_active' => 'boolean',
            'approved_at' => 'datetime',
            'start_date' => 'date',
            'end_date' => 'date',
            'highlights' => 'json',
            'included' => 'json',
            'extra_photos' => 'json',
        ];
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    public function slots(): HasMany
    {
        return $this->hasMany(TourDepartureSlot::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(TourItinerary::class)->orderBy('day_number');
    }

    public function pickupPoints(): HasMany
    {
        return $this->hasMany(TourPickupPoint::class)->orderBy('order');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PackageStatus::Published->value);
    }

    public function scopePendingApproval(Builder $query): Builder
    {
        return $query->where('status', PackageStatus::PendingApproval->value);
    }

    public function scopeInternal(Builder $query): Builder
    {
        return $query->whereHas('vendor', function (Builder $vendorQuery): void {
            $vendorQuery->where('role', UserRole::Admin->value);
        });
    }

    public function coverImageUrl(): string
    {
        if (! $this->cover_image_path) {
            return asset('images/hero1.jpg');
        }

        $coverImagePath = ltrim($this->cover_image_path, '/');

        if (Str::startsWith($coverImagePath, ['http://', 'https://'])) {
            return $coverImagePath;
        }

        return Storage::disk('public')->url($coverImagePath);
    }

    public static function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $suffix = 1;

        while (static::withTrashed()->where('slug', $slug)->exists()) {
            $slug = sprintf('%s-%s', $baseSlug, $suffix);
            $suffix++;
        }

        return $slug;
    }
}
