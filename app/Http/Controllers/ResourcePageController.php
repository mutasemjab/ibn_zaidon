<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\POS;
use App\Models\PreviousYearExam;
use App\Models\QuestionBank;
use App\Models\Subject;
use App\Models\Worksheet;
use Illuminate\Http\Request;

class ResourcePageController extends Controller
{
    public function worksheets(Request $request)
    {
        $subjects = Subject::where('is_active', true)->orderBy('name_ar')->get();

        $query = Worksheet::with('subject')
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at');

        if ($request->filled('subject')) {
            $query->where('subject_id', (int) $request->subject);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn ($qb) => $qb
                ->where('title_ar', 'like', "%{$q}%")
                ->orWhere('title_en', 'like', "%{$q}%")
            );
        }

        $items = $query->paginate(15)->withQueryString();

        return view('front.worksheets', compact('items', 'subjects'));
    }

    public function previousYears(Request $request)
    {
        $subjects = Subject::where('is_active', true)->orderBy('name_ar')->get();

        $query = PreviousYearExam::with('subject')
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('year');

        if ($request->filled('subject')) {
            $query->where('subject_id', (int) $request->subject);
        }
        if ($request->filled('year')) {
            $query->where('year', (int) $request->year);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn ($qb) => $qb
                ->where('title_ar', 'like', "%{$q}%")
                ->orWhere('title_en', 'like', "%{$q}%")
            );
        }

        $items = $query->paginate(15)->withQueryString();
        $years = PreviousYearExam::where('status', true)
            ->distinct()->orderByDesc('year')->pluck('year');

        return view('front.previous-years', compact('items', 'subjects', 'years'));
    }

    public function questionBanks(Request $request)
    {
        $subjects = Subject::where('is_active', true)->orderBy('name_ar')->get();

        $query = QuestionBank::with('subject')
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at');

        if ($request->filled('subject')) {
            $query->where('subject_id', (int) $request->subject);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn ($qb) => $qb
                ->where('title_ar', 'like', "%{$q}%")
                ->orWhere('title_en', 'like', "%{$q}%")
            );
        }

        $items = $query->paginate(15)->withQueryString();

        return view('front.question-bank', compact('items', 'subjects'));
    }

    public function pos(Request $request)
    {
        $cities = City::orderBy('name_ar')->get();

        $query = POS::with('city');

        if ($request->filled('city')) {
            $query->where('city_id', (int) $request->city);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(fn ($qb) => $qb
                ->where('name_ar', 'like', "%{$q}%")
                ->orWhere('name_en', 'like', "%{$q}%")
                ->orWhere('phone',   'like', "%{$q}%")
            );
        }

        $items = $query->orderBy('name_ar')->paginate(20)->withQueryString();

        return view('front.pos', compact('items', 'cities'));
    }
}
