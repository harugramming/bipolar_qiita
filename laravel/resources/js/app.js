import './bootstrap'
import './display_more'
import $ from 'jquery'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import FollowButton from './components/FollowButton'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    FollowButton,
  }
})


// ツールバー機能の設定
var toolbarOptions = [
    //見出し
    [{
        'header': [1, 2, 3, false]
    }],
    //太字、斜め、アンダーバー
    ['bold', 'italic', 'underline'],
    // リスト
    [{
            'list': 'ordered'
        },
        {
            'list': 'bullet'
        }
    ],
    //画像挿入
    ['image'],
    //URLリンク
    ['link']
];
if(document.URL.match(/create/)){
var quill = new Quill('#editor', {
theme: 'snow',
modules: {
    //ツールバーの設定
    toolbar: toolbarOptions
},
});

quill.on('text-change', function(delta, oldDelta, source) {
    $('input[name=body]').val(auto_link($('.ql-editor').html()));
});
}
function auto_link(val) {
    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
    return val.replace(exp,"<a target='_blank' href='$1'>$1</a>");
  }

$('#profile_update_button').on('click',function(){
    $('#profile_text').val(auto_link($('#profile_text').val()));
    $('#profile_update_form').submit();
})
