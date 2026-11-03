<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    use ApiResponse;

    // GET /pages/{slug} — static content page (terms, privacy, about, support, …)
    public function show(string $slug): JsonResponse
    {
        $page = Page::where('slug', $slug)->first();

        if (! $page) {
            return $this->error(
                app()->getLocale() === 'ar' ? 'الصفحة غير موجودة' : 'Page not found',
                404
            );
        }

        return $this->success([
            'title'      => $page->title,
            'body'       => $page->body,
            'updated_at' => $page->updated_at?->toIso8601String(),
        ]);
    }
}
