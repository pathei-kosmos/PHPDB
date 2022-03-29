<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles/main.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-2">
    <a class="navbar-brand" href="#">PHPDB</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="addUser.php">Add User</a>
        <a class="nav-item nav-link active" href="displayUsers.php"><u>Display Users</u></a>
        <a class="nav-item nav-link active" href="modifyUser.php">Modify User</a>
        </div>
    </div>
    </nav>
    <div class="container">
    <div class="title">
            <h1>Display Users</h1>
        </div>
    <ul class="list-group list-group-flush">
        <!--<li class="list-group-item ligrid"><span>Cras</span><span>justo</span><span>odio</span></li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Morbi leo risus</li>
        <li class="list-group-item">Porta ac consectetur ac</li>
        <li class="list-group-item">Vestibulum at eros</li> -->
        <?php
            include 'dbLogin.php';
            include 'functions.php';
            displayUsers($db);
            if (isset($_GET['modify'])) {
                echo "<div class='alert alert-warning mt-4' role='alert'>You must first select a user to edit.</div>";
                echo "<script>setTimeout(()=>{document.location.href='displayUsers.php';}, 1500);</script>";
            }
        ?>
    </ul>
    </div>
</body>
</html>