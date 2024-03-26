<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>W1 assingment D</title>
</head>
<body>

    <h1>Task for the day</h1>

    <ul>
        
    <li>
        <strong>Name: </strong> <?= $task['title'];?>
    </li>

    <li>
        <strong>Due Date: </strong> <?= $task['due'];?>
    </li>

    <li>
        <strong>Personal Responsible: </strong> <?= $task['assigned_to'];?>
    </li>

    <li>
        <strong>Status: </strong> <?= $task['completed'] ? 'Complete' : 'Incomplete';?>
    </li>

    </ul>
    

    <!-- Legacy Code ----------------------
    <?php foreach ($task as $heading => $value) : ?>
        <li>
            <strong><?= ucwords($heading); ?>: </strong> <?= $value; ?>
        </li>

     <?php endforeach; ?>
    -->
</body>
</html>