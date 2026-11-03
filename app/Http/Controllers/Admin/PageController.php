<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        // Content editing — same permission as Site Settings; these are a
        // fixed set of pages the app depends on by slug, not a free resource
        // (no create/delete), so a dedicated permission group isn't needed.
        $this->middleware($this->perm('setting-edit'));
    }

    public function index()
    {
        $pages = Page::orderBy('slug')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'body_ar'  => 'nullable|string',
            'body_en'  => 'nullable|string',
        ]);

        $page->update($data);

        return redirect()->route('admin.pages.index')
            ->with('success', __('messages.page_updated'));
    }
}
