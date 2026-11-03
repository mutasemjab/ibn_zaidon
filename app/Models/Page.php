<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title_ar', 'title_en', 'body_ar', 'body_en',
    ];

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->title_ar ?? $this->title_en)
            : ($this->title_en ?? $this->title_ar);
    }

    public function getBodyAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->body_ar ?? $this->body_en ?? '')
            : ($this->body_en ?? $this->body_ar ?? '');
    }
}
