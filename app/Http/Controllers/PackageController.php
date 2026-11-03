<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::active()
            ->withCount('courses')
            ->with('courses')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return view('front.packages', compact('packages'));
    }

    public function show(int $id)
    {
        $package = Package::active()
            ->with(['courses.teacher', 'courses.category'])
            ->findOrFail($id);

        return view('front.package-show', compact('package'));
    }
}
