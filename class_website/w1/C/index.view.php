<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CW w1 arrays</title>
   
</head>
<body>

    <h3 class="project-headings">Assignment 1: Create an array of any five animals, and then loop over them with a 'foreach' loop, then display them on the page.</h3>
    <hr>
    <ul>
        <?php foreach ($animals as $animal) : ?>
            <li><?= $animal; ?></li>
        <?php endforeach; ?>

        
    </ul>
    <hr>
    <a href="../">Back</a>


    
</body>
</html>