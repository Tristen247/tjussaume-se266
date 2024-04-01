<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>W1 assingment D</title>

  
</head>
<body>
    <h3 class="project-headings" id="text">Assignment 3:  Continue tinkering with conditionals. Add a new boolean to your task array, and use its value to branch off into two different paths within your HTML. Also add some Dingbats for a fun and easy to display infomation.</h3>
    <hr>

    <ul id="text">
            
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

    <hr>
    <a href="../">Back</a>
    



    <!-- Legacy Code - Dynamic display --------------------
    <?php foreach ($task as $heading => $value) : ?>
        <li>
            <strong><?= ucwords($heading); ?>: </strong> <?= $value; ?>
        </li>

     <?php endforeach; ?>
    -->
</body>
</html>