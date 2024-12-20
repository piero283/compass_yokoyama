<?php
namespace App\Calendars\General;


use Carbon\Carbon;

class CalendarWeek{
  protected $carbon;
  protected $index = 0;

  function __construct($date, $index = 0){
    $this->carbon = new Carbon($date);
    $this->index = $index;
  }

  function getClassName(){
    return "week-" . $this->index;
  }

  /**
   * @return
   */

  function getDays(){
    $days = [];
    $startDay = $this->carbon->copy()->startOfWeek();
    $lastDay = $this->carbon->copy()->endOfWeek();
    $tmpDay = $startDay->copy();
    //dd($startDay, $tmpDay);

    while($tmpDay->lte($lastDay)){//11/25デバッグ確認済
      //dump($tmpDay);//2024-11-25 から 2025-01-05
      if($tmpDay->month != $this->carbon->month){
        $day = new CalendarWeekBlankDay($tmpDay->copy());
        $days[] = $day;
      }else{
        $day = new CalendarWeekDay($tmpDay->copy());
        $days[] = $day;
      }
        $tmpDay->addDay(1);//更新後11/26でデバッグ確認済
    }
    //dd($days); //11/25-30はCalendarWeekBlankDay、12/1はCalendarWeekDayでデバッグ確認済
    return $days;
  }
}
