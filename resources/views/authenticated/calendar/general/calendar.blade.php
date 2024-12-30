<x-sidebar>
  <div class="vh-100 pt-5" style="background:#ECF1F6;">
    <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
      <div class="w-75 m-auto border" style="border-radius:5px;">

        <p class="text-center">{{ $calendar->getTitle() }}</p>
        <div class="">
          {!! $calendar->render() !!}
        </div>
      </div>
      <div class="text-right w-75 m-auto">
        <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
      </div>
    </div>
  </div>

  <!-- キャンセル確認モーダル -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
        <div class="modal-body">
          <p>予約日: <span id="modalReserveDate"></span></p>
          <p>時間: <span id="modalReservePart"></span></p>
          <p>上記の予約をキャンセルしてもよろしいですか？</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
          <form action="/delete/calendar" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="hiddenReserveDate" name="reserve_date" value="">
            <button type="submit" class="btn btn-danger">キャンセル</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-sidebar>
