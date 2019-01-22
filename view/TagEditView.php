
<?php require_once ('HeaderView.php')?>
<div class="main">
    <h2>タグ一覧</h2>
    <form method="post" action="../tag/edited">
        <div class="tag-input">
            <input type="text" name="tag" size="40" value="<?php echo $edittag['name']?>">
            <input type="hidden" name="tagId" size="40" value="<?php echo $edittag['id']?>">
            <input name='editok' type='submit' value='完了'>
        </div>
    </form>
</div>
</body>
</html>