<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CS w1 assingment D</title>
</head>
<body>

    <h3 class="project-headings">Assignment 2: Create an associative array for a task. This array should include such details as the title of the task, its due date, who it's assigned to, and whether it has been completed.</h3>
    <hr>
    <ul>
        <?php foreach($task as $info => $details) : ?>
            <li> <strong><?= $info; ?>:</strong> <?= $details; ?> </li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <a href="../">Back</a>
    
</body>
</html>