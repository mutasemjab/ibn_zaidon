<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(int $id)
    {
        $category = Category::active()
            ->with([
                'parent.parent',
                'children' => fn ($q) => $q->where('is_active', true)->orderBy('order_index'),
                'children.subjects' => fn ($q) => $q
                    ->where('is_active', true)
                    ->orderBy('order_index')
                    ->withCount(['courses' => fn ($q) => $q->where('is_published', true)]),
                'children.children' => fn ($q) => $q->where('is_active', true)->orderBy('order_index'),
                'children.children.subjects' => fn ($q) => $q
                    ->where('is_active', true)
                    ->orderBy('order_index')
                    ->withCount(['courses' => fn ($q) => $q->where('is_published', true)]),
                'subjects' => fn ($q) => $q
                    ->where('is_active', true)
                    ->orderBy('order_index')
                    ->withCount(['courses' => fn ($q) => $q->where('is_published', true)]),
            ])
            ->findOrFail($id);

        return view('front.category', compact('category'));
    }
}
