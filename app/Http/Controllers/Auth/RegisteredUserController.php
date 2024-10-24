<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

use App\Models\Users\Subjects;
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
        $subjects = Subjects::all();
        return view('auth.register.register', compact('subjects'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //新規登録のバリデーション
        $request->validate([
            'over_name' =>'required|string|max:10',
            'under_name' =>'required|string|max:10',
            'over_name_kana' =>'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana' =>'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address' =>'required|email|unique:users,mail_address',
            'sex' =>'required|in:male,female,other',
            'old_year' => 'required|integer|between:2000,' . date('Y'),
            'old_month' => 'required|integer|between:1,12',
            'old_day' => 'required|integer|between:1,31',
            'role' =>'required|in:講師(国語),講師(数学),教師(英語),生徒',
            'password' =>'required|between:8,30|confirmed',
        ]);

        DB::beginTransaction();
        try{
            $old_year = $request->old_year;
            $old_month = $request->old_month;
            $old_day = $request->old_day;
            $data = $old_year . '-' . $old_month . '-' . $old_day;
            $birth_day = date('Y-m-d', strtotime($data));
            $subjects = $request->subject;

            $user_get = User::create([
                'over_name' => $request->over_name,
                'under_name' => $request->under_name,
                'over_name_kana' => $request->over_name_kana,
                'under_name_kana' => $request->under_name_kana,
                'mail_address' => $request->mail_address,
                'sex' => $request->sex,
                'birth_day' => $birth_day,
                'role' => $request->role,
                'password' => bcrypt($request->password)
            ]);
            if($request->role == 4){
                $user = User::findOrFail($user_get->id);
                $user->subjects()->attach($subjects);
            }
            DB::commit();
            return view('auth.login.login');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('loginView');
        }
    }
}
