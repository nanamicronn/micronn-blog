<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 10:17
 */
-->
<html>
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>
<div class="header">
<h1>Special Blog</h1>
<ul class="header-menu">
    <li><a href="list.php">記事一覧</a></li>
    <li><a href="post.php">記事作成</a></li>
    <li><a href="category.php">カテゴリ作成</a></li>
    <li><a href="tag.php">タグ作成</a></li>
    <li><a href="logout.php">ログアウト</a></li>
</ul>
<form action="list.php" method="get">
    <input type="text" name="searchvalue" value="<?php echo isset($tt) ? $tt : '';?>">
    <input type="submit" name="search" value="検索">
</form>
</div>