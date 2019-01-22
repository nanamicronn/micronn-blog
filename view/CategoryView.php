
<?php require_once ('HeaderView.php')?>
<div class="main">
    <h2>カテゴリー一覧</h2>
    <form method="post" action="./category/add">
        <div class="category-input">
            <input type="text" name="category" size="40" value="">
            <input type="hidden" name="categoryId" size="40" value="">
            <input name='add' type='submit' value='追加'>
        </div>
    </form>
    <?php foreach ($categories as $category){ ?>
        <div class="category">
            <p><?php echo nl2br($category['name'])?></p>
            <form action="./category/delete" method="post">
                <input type="submit" name="delete" value="削除">
                <input type="hidden" name="categoryId" value="<?php echo $category['id'];?>">
            </form>
            <form action="./category/edit" method="post">
                <input type="submit" name="edit" value="編集">
                <input type="hidden" name="categoryId" value="<?php echo $category['id'];?>">
            </form>
        </div>
    <?php }?>
</div>
</body>
</html>