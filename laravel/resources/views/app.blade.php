<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta content="bipolarTipsは双極性障害の方向けの知識共有サービスです。双極性障害の症状を上手くコントロールするための療法や心構え、また利用できる社会制度などの知識をみんなが共有できる状態にしたい。それによって、双極性障害の方の幸せで健康的な生活を実現したい。そんな想いで開発をしたのがbipolarTipsです。" name="description">
  <title>
    @yield('title')
  </title>
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  {{-- Quill --}}
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
</head>

<body>
<div id="app">
  @yield('content')
</div>
    {{-- Quill --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="{{ mix('js/app.js') }}"></script>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>

</body>

</html>
