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
        $getDate = $request->input('getData', []); // デフォルトは空配列
        $getPart = $request->input('getPart', []); // デフォルトは空配列

        // 今日以降の日付のみを抽出　＊解説必須
        $getDate = array_filter($getDate, function($date) {
            return strtotime($date) >= strtotime(date('Y-m-d')); // 今日以降の日付
        });

        //ここが原因ポイ
        dd($getDate, $getPart);

        // 配列を結合
        //$reserveDays = array_filter(array_combine($getDate, $getPart));

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

}
