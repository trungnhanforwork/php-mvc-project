<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Categories:</h1>
    <?php foreach($categories as $category): ?>
        <h3><?= htmlspecialchars($category["name"])?></h3>
    <?php endforeach;?>
</body>
</html>