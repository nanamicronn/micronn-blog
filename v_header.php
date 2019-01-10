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
    <li><a href="#">カテゴリ作成</a></li>
    <li><a href="#">タグ作成</a></li>
    <li><a href="logout.php">ログアウト</a></li>
</ul>
<form action="" method="">
    <input type="text" name="search" value="<?php echo $searchValue?>">
    <input type="submit" name="" value="検索">
</form>
</div>