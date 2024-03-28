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
        <strong>Complete: </strong> 

        <?php if ($task["completed"]) : ?>
            <span class="icon">&#9989;</span> <!--display green check if complete-->
        <?php else : ?>
            <span class="icon">&#10060;</span><!--else red X-->
        <?php endif; ?>
    </li>

    <li>
        <strong>Started: </strong> 

        <?php if ($task["started"]) : ?> 
            <span class="icon">&#9989;</span><!--display green check if started-->
        <?php else : ?>
            <span class="icon">&#10060;</span><!--else red X-->
        <?php endif; ?>
    </li>

    </ul>
    






    <!-- Legacy Code - Dynamic 
    <?php foreach ($task as $heading => $value) : ?>
        <li>
            <strong><?= ucwords($heading); ?>: </strong> <?= $value; ?>
        </li>

     <?php endforeach; ?>
    -->
</body>
</html>