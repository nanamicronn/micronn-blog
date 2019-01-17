<!--
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-15
 * Time: 14:41
 */
-->

<div class="main">
    <h2>カテゴリー一覧</h2>
    <form method="post" action="category.php">
        <div class="category-input">
            <input type="text" name="category" size="40" value="<?php echo $editcategory['name']?>">
            <input type="hidden" name="categoryId" size="40" value="<?php echo $editcategory['id']?>">
            <?php
            if($isEdit){
                echo "<input name='editok' type='submit' value='完了'>";
            }else{
                echo "<input name='add' type='submit' value='追加'>";
            }
            ?>

        </div>
    </form>
    <?php foreach ($categories as $category){ ?>
        <div class="category">
            <p><?php echo nl2br($category['name'])?></p>
<!--            <form action="list.php" method="post">-->
<!--                <input type="hidden" name="postId" value="--><?php //echo $list['id'];?><!--">-->
<!--                <input type="submit" name="delete" value="削除">-->
<!--                <input type="submit" name="edit" value="編集">-->
<!--            </form>-->
            <form action="category.php" method="post">
<!--                <input type="hidden" name="postId" value="--><?php //echo $list['id'];?><!--">-->
                <input type="submit" name="delete" value="削除">
                <input type="submit" name="edit" value="編集">
                <input type="hidden" name="categoryId" value="<?php echo $category['id'];?>">
            </form>
        </div>
    <?php }?>
</div>
</body>
</html>