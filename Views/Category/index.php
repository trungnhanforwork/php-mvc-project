
    <h1>Categories:</h1>
    <?php foreach($categories as $category): ?>
        <h3><?= htmlspecialchars($category["name"])?></h3>
    <?php endforeach;?>
</body>
</html>