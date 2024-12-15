<?php
namespace App\Calendars\General;
use Carbon\Carbon;
use Auth;

class CalendarView{
  private $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();

    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays();

      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");
        $isPastDay = ($startDay <= $day->everyDay() && $toDay >= $day->everyDay());

        $html[] = '<td class="calendar-td ' . ($isPastDay ? 'past-day' : $day->getClassName()) . '">';
        $html[] = $day->render();

        if(in_array($day->everyDay(), $day->authReserveDay())){
          //過去日に予約がある場合　※後で下記内容確認
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          // hiddenフィールドを追加
          $html[] = '<input type="hidden" name="getDate[]" value="' . $day->everyDay() . '">';
          $html[] = '<input type="hidden" name="getPart[]" value="' . $reservePart . '">';

          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }

          if($isPastDay){
            // 過去日に予約がある場合は参加した部を表示(' . $reservePart . '参加)←追記
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">' . $reservePart . '参加</p>';
          }else{
            // 現在または未来日の予約
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate
            ($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
          }
        }else {
            if($isPastDay) {
              // 過去日の処理
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
            }else{
                // 未来日の処理
                $html[] = $day->selectPart($day->everyDay());
            }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }


  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
