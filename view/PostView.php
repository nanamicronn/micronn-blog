
<?php require_once ('HeaderView.php')?>
<div class="main">
<h2>記事作成</h2>
<form method="post" action="./post/add">
<div class="post-input">
    <p>題名</p>
    <p><input type="text" name="title" size="40" value=""></p>
    <p>カテゴリ</p>
    <div class="post-input-category">
        <select name="category">
            <?php echo "<option value='' hidden>Choose</option>"?>
            <?php foreach ($categories as $category) {?>
                <?php echo "<option value='".$category['id']."'>".$category['name']."</option>"?>
            <?php }?>
        </select>
    </div>
    <p>本文</p>
    <p><textarea name="content" rows="8" cols="40" maxlength="255"></textarea></p>
    <p><input type="hidden" name="postId" value=""></p>
    <p>
        <?php foreach ($tags as $tag) {?>
            <span><input type="checkbox" name="<?php echo $tag['id'];?>" value="<?php echo $tag['name'];?> "><?php echo $tag['name'];?></span>
        <?php }?>
    </p>
    <input type="hidden" name="csrf_token" value="<?php Csrf::get()?>">
    <p><input name='save' type='submit' value='投稿'></p>
</div>
</form>
</div>
</body>
</html>