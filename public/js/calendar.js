document.addEventListener('DOMContentLoaded', () => {
  const cancelModal = document.getElementById('cancelModal');
  cancelModal.addEventListener('show.bs.modal', (event) => {
    // ボタンから情報を取得
    const button = event.relatedTarget;
    const reserveDate = button.getAttribute('data-reserve-date');
    const reservePart = button.getAttribute('data-reserve-part');

    // モーダル内の要素を更新
    document.getElementById('modalReserveDate').textContent = reserveDate;
    document.getElementById('modalReservePart').textContent = reservePart;

    // フォームのhiddenフィールドに予約情報をセット
    document.getElementById('hiddenReserveDate').value = reserveDate;
  });
});
