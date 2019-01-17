<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-16
 * Time: 11:35
 */
-->
<div class="main">
    <h2>タグ一覧</h2>
    <form method="post" action="tag.php">
        <div class="tag-input">
            <input type="text" name="tag" size="40" value="<?php echo $edittag['name']?>">
            <input type="hidden" name="tagId" size="40" value="<?php echo $edittag['id']?>">
            <?php
            if($isEdit){
                echo "<input name='editok' type='submit' value='完了'>";
            }else{
                echo "<input name='add' type='submit' value='追加'>";
            }
            ?>

        </div>
    </form>
    <?php foreach ($tags as $tag){ ?>
        <div class="tag">
            <p><?php echo nl2br($tag['name'])?></p>
            <!--            <form action="list.php" method="post">-->
            <!--                <input type="hidden" name="postId" value="--><?php //echo $list['id'];?><!--">-->
            <!--                <input type="submit" name="delete" value="削除">-->
            <!--                <input type="submit" name="edit" value="編集">-->
            <!--            </form>-->
            <form action="tag.php" method="post">
                <!--                <input type="hidden" name="postId" value="--><?php //echo $list['id'];?><!--">-->
                <input type="submit" name="delete" value="削除">
                <input type="submit" name="edit" value="編集">
                <input type="hidden" name="tagId" value="<?php echo $tag['id'];?>">
            </form>
        </div>
    <?php }?>
</div>
</body>
</html>