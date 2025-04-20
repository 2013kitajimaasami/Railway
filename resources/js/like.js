$(function () {
  // like.on('click', function () {
  $('.like-toggle').on('click', function (e) {
    e.preventDefault();

    let $this = $(this); // クリックされたlike-toggleのみを表現する
    let likeSpotId = $this.data('spot-id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/spot/' + likeSpotId + '/like',
      type: 'POST',
      dataType: 'json',
      data: {
        likeSpotId: likeSpotId //いいねされた投稿のidを送る
      },
    })
      //通信成功した時の処理
      .done(function (data) {
        // $this.toggleClass('liked');
        if($this.hasClass('liked')){ // fas:塗りつぶし、far:枠線のみのハート
          $this.removeClass('liked');
          $this.removeClass('fas');
          $this.addClass('far');
        }else{
          $this.addClass('liked');
          $this.removeClass('far');
          $this.addClass('fas');
        }
        $this.next('.like-counter').html(data.likes_count);
      })
      //通信失敗した時の処理
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('fail');
        console.log('data');
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        console.log("URL            : " + url);
      });
  });
});