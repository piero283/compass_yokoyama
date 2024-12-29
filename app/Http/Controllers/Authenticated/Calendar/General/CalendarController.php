<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }



    public function reserve(Request $request){
        $getPart = $request->getPart;
        $getDate = $request->getDate;

        // 配列を結合
        $reserveDays = array_filter(array_combine($getDate, $getPart));

        DB::beginTransaction();
        try {
            foreach ($reserveDays as $key => $value) {
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)
                    ->where('setting_part', $value)
                    ->first();

                if ($reserve_settings && $reserve_settings->limit_users > 0) {
                    $reserve_settings->decrement('limit_users');
                    $reserve_settings->users()->attach(Auth::id());
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $reserveDate = $request->input('reserve_date');

            // 予約情報を取得
            $reserveSetting = ReserveSettings::where('setting_reserve', $reserveDate)
                ->whereHas('users', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->first();

            if ($reserveSetting) {
                // ユーザー予約を削除
                $reserveSetting->users()->detach(Auth::id());

                // 予約枠を増やす
                $reserveSetting->increment('limit_users');
            }

            DB::commit();
            return redirect()->route('calendar.general.show', ['user_id' => Auth::id()])
                            ->with('success', '予約をキャンセルしました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('calendar.general.show', ['user_id' => Auth::id()])
                            ->with('error', '予約のキャンセルに失敗しました。');
        }
    }


}
