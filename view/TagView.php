
<?php require_once ('HeaderView.php')?>
<div class="main">
    <h2>タグ一覧</h2>
    <form method="post" action="./tag/add">
        <div class="tag-input">
            <input type="text" name="tag" size="40" value="">
            <input type="hidden" name="tagId" size="40" value="">
            <input name='add' type='submit' value='追加'>

        </div>
    </form>
    <?php foreach ($tags as $tag){ ?>
        <div class="tag">
            <p><?php echo nl2br($tag['name'])?></p>
            <form action="./tag/delete" method="post">
                <input type="submit" name="delete" value="削除">
                <input type="hidden" name="tagId" value="<?php echo $tag['id'];?>">
            </form>
            <form action="./tag/edit" method="post">
                <input type="submit" name="edit" value="編集">
                <input type="hidden" name="tagId" value="<?php echo $tag['id'];?>">
            </form>
        </div>
    <?php }?>
</div>
</body>
</html>