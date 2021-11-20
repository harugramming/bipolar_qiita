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
    <h2>見よ！</h2>
    <p>これがリッチテキストエディタ「<strong>Quill</strong>」の実力だ！</p>
</div>
