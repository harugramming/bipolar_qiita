/* ここには、表示するリストの数を指定します。 */
var moreNum = 16;

/* 表示するリストの数以降のリストを隠しておきます。 */
$('.list-item:nth-child(n + ' + (moreNum + 1) + ')').addClass('is-hidden');

/* 全てのリストを表示したら「もっとみる」ボタンをフェードアウトします。 */
$('.list-btn').on('click', function() {
    console.log("click");
  $('.list-item.is-hidden').slice(0, moreNum).removeClass('is-hidden');
  if ($('.list-item.is-hidden').length == 0) {
    $('.list-btn').fadeOut();
  }
});

/* リストの数が、表示するリストの数以下だった場合、「もっとみる」ボタンを非表示にします。 */
$(function() {
  var list = $(".articles_cards_list div").length;
    if (list < moreNum) {
      $('.list-btn').addClass('is-btn-hidden');
  }
});