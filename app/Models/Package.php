<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title_ar', 'title_en',
        'description_ar', 'description_en',
        'pick_count', 'price', 'old_price', 'image',
        'is_active', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'old_price'   => 'decimal:2',
        'pick_count'  => 'integer',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->title_ar ?? $this->title_en)
            : ($this->title_en ?? $this->title_ar);
    }

    public function getDescriptionAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->description_ar ?? $this->description_en ?? '')
            : ($this->description_en ?? $this->description_ar ?? '');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'package_courses');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Savings vs old_price when set by the admin; otherwise vs the sum of the
     * cheapest pick_count courses in the pool (the best a student could do
     * buying individually), so the badge never overstates the discount.
     */
    public function getDiscountPercentageAttribute(): int
    {
        $reference = $this->old_price && $this->old_price > 0
            ? (float) $this->old_price
            : $this->courses->sortBy('price')->take($this->pick_count)->sum('price');

        if (! $reference || $reference <= $this->price) {
            return 0;
        }

        return (int) round((($reference - $this->price) / $reference) * 100);
    }
}
