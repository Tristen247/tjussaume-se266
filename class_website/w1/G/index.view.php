<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FizzBuzz</title>
    <!--My CSS-->
    <link href="..\include\style.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Your Tasks</h1>
    <p>Implement the web application Fizz Buzz.</p>
    <h2>Application Requirements:</h2>
    <ul>
        <li>Display the numbers 1 through 100 except in the following cases:
            <ul>
                <li>Display <em>fizz</em> if the number a multiple of 2,</li>
                <li>Display <em>buzz</em> if the number a multiple of 3</li>
                <li>Display <em>fizz buzz</em> if the number is a multiple of both two and three.</li>
            </ul>
        </li>
    </ul>
    <p>Your solution must include a for-loop that calls a function <code>fizzBuzz</code>.</p>
    <p>The function returns the correct string, based on the number you pass in:</p>
    <a id="btn-links" class="btn btn-primary" href="..\" role="button">Back</a>
    <hr>
    


    <!--call the function in a for loop-->
    <?php 
        for ($i = 1; $i <= 100; $i++) {
           echo fizzBuzz($i) . "<br>";
        }
    ?>

</body>
</html>