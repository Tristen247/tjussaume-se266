<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>W1 assingment D</title>
</head>
<body>

    <ul>
        <?php foreach($task as $info => $details) : ?>
            <li> <strong><?= $info; ?>:</strong> <?= $details; ?> </li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>