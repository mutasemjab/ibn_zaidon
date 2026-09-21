<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('home');
        }

        return view('front.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone'    => ['required', 'string'],
            'password' => ['required'],
        ]);

        $student = Student::where('phone', trim($request->phone))->first();

        if (! $student || ! Hash::check($request->password, $student->password)) {
            return back()
                ->withInput($request->only('phone'))
                ->withErrors(['phone' => __('front.auth_login_error')]);
        }

        if (! $student->is_active) {
            return back()
                ->withInput($request->only('phone'))
                ->withErrors(['phone' => app()->getLocale() === 'ar'
                    ? 'الحساب موقوف، تواصل مع الإدارة'
                    : 'Account is suspended. Contact admin.']);
        }

        Auth::guard('student')->login($student, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function showRegister()
    {
        if (Auth::guard('student')->check()) {
            return redirect()->route('home');
        }

        return view('front.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:200'],
            'phone'       => ['required', 'string', 'max:20', 'unique:students,phone'],
            'national_id' => ['nullable', 'string', 'max:50'],
            'email'       => ['nullable', 'email', 'max:200', 'unique:students,email'],
            'password'    => ['required', 'confirmed', Password::min(8)],
            'terms'       => ['accepted'],
        ]);

        $student = Student::create([
            'name'        => $validated['name'],
            'phone'       => $validated['phone'],
            'national_id' => $validated['national_id'] ?? null,
            'email'       => $validated['email'] ?? null,
            'password'    => $validated['password'],
            'is_active'   => true,
        ]);

        Auth::guard('student')->login($student);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('register_success', __('front.auth_register_success'));
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
