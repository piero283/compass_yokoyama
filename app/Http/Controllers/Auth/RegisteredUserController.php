<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Requests\CustomDateRequest;
use DB;

use App\Models\Users\Subject;
use App\Models\Users\User;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('auth.register.register', ['subjects' => $subjects]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CustomDateRequest $request)
    {
        DB::beginTransaction();
        try {
            $birth_day = sprintf('%04d-%02d-%02d', $request->old_year, $request->old_month, $request->old_day);
            $subjects = $request->subject;

            $user_get = User::create([
                'over_name' => $request->over_name,
                'under_name' => $request->under_name,
                'over_name_kana' => $request->over_name_kana,
                'under_name_kana' => $request->under_name_kana,
                'mail_address' => $request->mail_address,
                'sex' => $request->sex,
                'birth_day' => $request->birth_day,
                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);

            if ($request->role == 4) {
                $user_get->subjects()->attach($subjects);
            }

            DB::commit();
            return view('auth.login.login');
            } catch (\Exception $e)
                {
                    DB::rollback();
                    \Log::error('Registration failed: ' . $e->getMessage());
                    return redirect()->route('loginView')->with('error', '登録中に問題が発生しました。');
                }
    }
}
