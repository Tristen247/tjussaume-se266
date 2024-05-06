<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap V5.3-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--Font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <!--My CSS-->
        <link href="style.css" rel="stylesheet">
</head>
<body>
    <a href="login.php">Return to login</a>
    <h1 class="page-title"> Please submit a request to reset you password. </h1>

    <form action="post">
        <div class="container">
            <div>
                <label for="work-email">Email (Work):</label>
            </div>
            <div>
                <input type="text">
            </div>

            <div>
                <label for="work-email">Last Name:</label>
            </div>
            <div>
                <input type="text">
            </div>

            <div>
                <label for="work-email">last 4 of SSN:</label>
            </div>
            <div>
                <input type="text">
            </div>

            <div>
                <label for="work-email">DOB:</label>
            </div>
            <div>
                <input type="date">
            </div>
            <br>
            <button
                type="submit"
                class="btn btn-primary"
            >
                Submit
            </button>
        </div>
        

    </form>
    
</body>
</html>