@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group" style="height:1px;margin:0;">
  <label></label>
  <input name="body" hidden style="height:1px;margin:0;">
</div>
<p style="margin: 0;
color: #888;
font-size: 16px;">本文</p>
<div id="editor" style="height:300px;">
    {!! $article->body ?? old('body') !!}
</div>
