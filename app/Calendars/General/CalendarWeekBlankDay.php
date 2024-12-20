<?php
namespace App\Calendars\General;

class CalendarWeekBlankDay extends CalendarWeekDay{
  function getClassName(){
    return "day-blank";
  }

  /**
   * @return
   */

  function render(){
    return '';
  }

  function selectPart($ymd){
    return '';
  }

  function getDate(){
    return '';
  }

  function cancelBtn(){
    return '';
  }

  function everyDay(){
      if ($this->carbon) {
          return $this->carbon->format('Y-m-d');
      } else {
          return 'Invalid Carbon instance'; // 初期化されていない場合にエラー処理
      }
  }


}
