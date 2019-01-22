
<?php require_once ('HeaderView.php')?>
<div class="main">
    <h2>カテゴリー一覧</h2>
    <form method="post" action="../category/edited">
        <div class="category-input">
            <input type="text" name="category" size="40" value="<?php echo $editcategory['name']?>">
            <input type="hidden" name="categoryId" size="40" value="<?php echo $editcategory['id']?>">
            <input name='editok' type='submit' value='完了'>
        </div>
    </form>
</div>
</body>
</html>