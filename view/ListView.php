<?php require_once ('HeaderView.php')?>
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
            <form action="./delete" method="post">
                <input type="hidden" name="postId" value="<?php echo $list['id'];?>">
                <input type="submit" name="delete" value="削除">
                <input type="submit" name="edit" value="編集">
            </form>
        </div>
    <?php }?>
</div>
</body>
</html>