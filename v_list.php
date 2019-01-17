<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 12:14
 */
-->
<!--<html>-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>Blog</title>-->
<!--    <link rel="stylesheet" href="blog.css">-->
<!--</head>-->
<!--<body>-->
<!--<div class="header">-->
<!--<h1>Special Blog</h1>-->
<!--<ul class="header-menu">-->
<!--    <li><a href="list.php">記事一覧</a></li>-->
<!--    <li><a href="post.php">記事作成</a></li>-->
<!--    <li><a href="#">カテゴリ作成</a></li>-->
<!--    <li><a href="#">タグ作成</a></li>-->
<!--</ul>-->
<!--<form action="" method="">-->
<!--    <input type="text" name="search" value="--><?php //echo $searchValue?><!--">-->
<!--    <input type="submit" name="" value="検索">-->
<!--</form>-->
<!--</div>-->

<div class="main">
<h2>記事一覧</h2>
<?php foreach ($lists as $list){ ?>
<div class="list">
    <h2><?php echo $list['title']?></h2>
    <p class="list-date"><?php echo substr($list['time'], 0, strcspn($list['time'],' '));?> <span>カテゴリ：<?php echo $list['category_name']; ?></span></p>
    <p><?php echo nl2br($list['content'])?></p>
    <p>
    <?php foreach($taglists[($list['id'])] as $taglist) {?>
        <span>#<?php echo $taglist;?> </span>
    <?php };?>
    </p>
    <form action="list.php" method="post">
        <input type="hidden" name="postId" value="<?php echo $list['id'];?>">
        <input type="submit" name="delete" value="削除">
        <input type="submit" name="edit" value="編集">
    </form>
</div>
<?php }?>
</div>
</body>
</html>
