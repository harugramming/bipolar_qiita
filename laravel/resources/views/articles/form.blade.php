@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
  <label></label>
  <input name="body">
</div>
<div id="editor">
    {!! $article->body ?? old('body') !!}
</div>
