$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
  });

  $(document).on('click', '.like_btn', function (e) {
    e.preventDefault();
    $(this).addClass('un_like_btn');
    $(this).removeClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/like/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  $(document).on('click', '.un_like_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_like_btn');
    $(this).addClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });

  $('.edit-modal-open').on('click',function(){
    $('.js-modal').fadeIn();
    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});

$(function () {
  // 削除ボタンをクリックするとモーダルが表示される
  $(document).on('click', '.delete-modal-open', function (e) {
    e.preventDefault();
    const post_id = $(this).data('post_id'); // data属性を使用してpost_idを取得
    $('.delete-modal-hidden').val(post_id);
    $('.js-delete-modal').fadeIn(); // 削除モーダルを表示
  });

  // キャンセルボタンをクリックするとモーダルが閉じる
  $(document).on('click', '.js-delete-modal-close', function () {
    $('.js-delete-modal').fadeOut(); // モーダルを非表示
  });

  // OKボタンをクリックするとポストを削除
  $(document).on('click', '.js-delete-confirm', function () {
    const post_id = $('.delete-modal-hidden').val();

    $.post('/bulletin_board/delete/' + post_id, {
      _token: $('meta[name="csrf-token"]').attr('content')
    })
      .done(function () {
        $('#post-' + post_id).remove();
        $('.js-delete-modal').fadeOut();
        // 現在のページを別のURLに遷移する
        window.location.href = "/bulletin_board/posts";
      })
      .fail(function () {
        alert('削除に失敗しました');
      });
  });
});
