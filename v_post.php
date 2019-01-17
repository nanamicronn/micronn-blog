<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 16:17
 */
-->

<!--<html>-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>Post</title>-->
<!--    <link rel="stylesheet" href="blog.css">-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<div class="header">-->
<!--    <h1>Special Blog</h1>-->
<!--    <ul class="header-menu">-->
<!--        <li><a href="list.php">記事一覧</a></li>-->
<!--        <li><a href="post.php">記事作成</a></li>-->
<!--        <li><a href="#">カテゴリ作成</a></li>-->
<!--        <li><a href="#">タグ作成</a></li>-->
<!--    </ul>-->
<!--</div>-->
<div class="main">
<h2>記事作成</h2>
<form method="post" action="post.php">
<div class="post-input">
    <p>題名</p>
    <p><input type="text" name="title" size="40" value="<?php echo $posts['title']?>"></p>
    <p>カテゴリ</p>
    <div class="post-input-category">
        <select name="category">
                <?php echo "<option value='' hidden>Choose</option>"?>
                <?php foreach ($categories as $category) {?>
                <?php $posts['category_id']==$category['id'] ? $selected="selected" : $selected='';?>
                <?php echo "<option value='".$category['id']."'".$selected.">".$category['name']."</option>"?>
                <?php }?>
        </select>
    </div>
    <p>本文</p>
    <p><textarea name="content" rows="8" cols="40" maxlength="255"><?php echo $posts['content']?></textarea></p>
    <p><input type="hidden" name="postId" value="<?php echo $posts['id']?>"></p>
    <p>
    <?php foreach ($tags as $tag) {
        $checked='';
        if($isEdit){
            foreach ($posttaglists as $posttaglist) {
                if($tag['id'] == $posttaglist['tag_id']){
                    $checked="checked";
                    break;
                }else{
                    $checked='';
                }
            }
        }?>
        <span><input type="checkbox" name="<?php echo $tag['id'];?>" value="<?php echo $tag['name'];?> "<?php echo $checked;?>><?php echo $tag['name'];?></span>
    <?php }?>
    </p>
    <?php
    if($isEdit) {
        echo "<p><input name='editok' type='submit' value='完了'></p>";
    } else {
        echo "<p><input name='save' type='submit' value='投稿'></p>";
    }
        ?>
</div>
</form>
</div>
</body>
</html>