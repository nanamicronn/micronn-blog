<html>
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="./css/blog.css">
</head>
<body>
<div class="header">
    <h1>Special Blog</h1>
    <ul class="header-menu">
        <li><a href="./list">記事一覧</a></li>
        <li><a href="./post">記事作成</a></li>
        <li><a href="../Controller/category.php">カテゴリ作成</a></li>
        <li><a href="../Controller/tag.php">タグ作成</a></li>
        <li><a href="../Controller/logout.php">ログアウト</a></li>
    </ul>
    <form action="../Controller/list.php" method="get">
        <input type="text" name="searchvalue" value="">
        <input type="submit" name="search" value="検索">
    </form>
</div>