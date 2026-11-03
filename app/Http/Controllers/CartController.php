<?php

namespace App\Http\Controllers;

use App\Models\CardNumber;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $items    = $this->buildLineItems();
        $subtotal = collect($items)->sum('price');
        $discount = 0;
        $total    = $subtotal - $discount;

        return view('front.cart', compact('items', 'subtotal', 'discount', 'total'));
    }

    public function add(Request $request, int $id)
    {
        $course = Course::where('id', $id)->where('is_published', true)->firstOrFail();

        $cart = session('cart', []);
        $cart[$course->id] = 1;
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('cart_added', $course->title);
    }

    // Adds a package to the cart: the student picks exactly pick_count course
    // IDs from the package's eligible pool; they get grouped in the cart at
    // the package's fixed price instead of the sum of the individual prices.
    public function addPackage(Request $request, int $id)
    {
        $package = Package::active()->with('courses')->findOrFail($id);

        $request->validate([
            'course_ids'   => ['required', 'array', 'size:' . $package->pick_count],
            'course_ids.*' => ['integer'],
        ]);

        $poolIds     = $package->courses->pluck('id')->all();
        $selectedIds = array_map('intval', $request->input('course_ids'));

        if (count(array_diff($selectedIds, $poolIds)) > 0) {
            return back()->with('error', __('front.packages_invalid_selection'));
        }

        $cart = session('cart', []);
        foreach ($selectedIds as $courseId) {
            $cart[$courseId] = 1;
        }
        session(['cart' => $cart]);

        $cartPackages = session('cart_packages', []);
        $cartPackages[$package->id] = $selectedIds;
        session(['cart_packages' => $cartPackages]);

        return redirect()->route('cart.index')->with('cart_added', $package->title);
    }

    public function remove(int $id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return back()->with('cart_removed', true);
    }

    // Removing one course from a package would leave an incomplete, unpriced
    // group, so the whole package selection is dropped from the cart at once.
    public function removePackage(int $packageId)
    {
        $cartPackages = session('cart_packages', []);
        $courseIds    = $cartPackages[$packageId] ?? [];

        unset($cartPackages[$packageId]);
        session(['cart_packages' => $cartPackages]);

        $cart = session('cart', []);
        foreach ($courseIds as $courseId) {
            unset($cart[$courseId]);
        }
        session(['cart' => $cart]);

        return back()->with('cart_removed', true);
    }

    public function checkout()
    {
        if (! auth('student')->check()) {
            return redirect()->route('student.login');
        }

        $items = $this->buildLineItems();
        if (empty($items)) {
            return redirect()->route('cart.index');
        }

        return view('front.checkout', compact('items'));
    }

    public function activate(Request $request)
    {
        if (! auth('student')->check()) {
            return redirect()->route('student.login');
        }

        $request->validate([
            'card_number' => 'required|string|max:100',
        ]);

        $items = $this->getCart();
        if (empty($items)) {
            return redirect()->route('cart.index');
        }

        $cardNumber = CardNumber::where('number', trim($request->card_number))
            ->where('activate', 1) // active
            ->where('status', 2)   // not used
            ->where('sell', 1)     // sold
            ->first();

        if (! $cardNumber) {
            return back()
                ->withInput()
                ->with('activation_error', __('front.flash_card_invalid'));
        }

        $student    = auth('student')->user();
        $courseIds  = array_keys($items);

        DB::transaction(function () use ($student, $courseIds, $cardNumber) {
            foreach ($courseIds as $courseId) {
                Enrollment::firstOrCreate(
                    ['student_id' => $student->id, 'course_id' => $courseId],
                    [
                        'enrolled_at'          => now(),
                        'is_active'            => true,
                        'is_completed'         => false,
                        'progress_percentage'  => 0,
                    ]
                );
            }

            $cardNumber->update([
                'status'           => 1,
                'assigned_user_id' => $student->id,
            ]);
        });

        session()->forget(['cart', 'cart_packages']);

        return redirect()->route('home')
            ->with('activation_success', __('front.flash_courses_activated'));
    }

    private function getCart(): array
    {
        return session('cart', []);
    }

    /**
     * One line item per package group (priced once at the package price) plus
     * one line item per course that isn't part of any package in the cart.
     */
    private function buildLineItems(): array
    {
        $cart         = $this->getCart();
        $cartPackages = session('cart_packages', []);

        if (empty($cart)) {
            return [];
        }

        $courses = Course::with(['teacher', 'category'])
            ->whereIn('id', array_keys($cart))
            ->where('is_published', true)
            ->get()
            ->keyBy('id');

        $packagedCourseIds = [];
        $items = [];

        foreach ($cartPackages as $packageId => $courseIds) {
            $package         = Package::find($packageId);
            $packageCourses  = $courses->only($courseIds)->values();

            // The package was deleted, or one of its courses is gone/unpublished
            // since it was added — fall back to selling those courses individually
            // rather than silently dropping them from the cart.
            if (! $package || $packageCourses->count() !== count($courseIds)) {
                continue;
            }

            $packagedCourseIds = array_merge($packagedCourseIds, $courseIds);
            $items[] = [
                'type'    => 'package',
                'package' => $package,
                'courses' => $packageCourses,
                'price'   => (float) $package->price,
            ];
        }

        foreach ($courses as $course) {
            if (in_array($course->id, $packagedCourseIds, true)) {
                continue;
            }
            $items[] = [
                'type'   => 'course',
                'course' => $course,
                'price'  => (float) $course->price,
            ];
        }

        return $items;
    }
}
