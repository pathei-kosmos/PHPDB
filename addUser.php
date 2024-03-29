<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="styles/main.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-2">
    <a class="navbar-brand" href="#">PHPDB</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="addUser.php"><u>Add User</u></a>
        <a class="nav-item nav-link active" href="displayUsers.php">Display Users</a>
        <a class="nav-item nav-link active" href="modifyUser.php">Modify User</a>
        </div>
    </div>
    </nav>
    <div class="container">
    <div class="title">
            <h1>Add User</h1>
        </div>
    <form action="" method="post">
        <label for="name">Last Name :</label>
        <div class="div">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="User's last name" name="name">  
            </div>
        </div>
        <div class="div">
            <label for="firstName">First Name :</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="User's first name" name="firstName">  
            </div>
        </div>
        <div class="div">
            <label for="mail">Email :</label>
            <div class="input-group">
                <input type="email" class="form-control" placeholder="User's email" name="mail">  
            </div>
        </div>
        <div class="div">
            <label for="pwd">Password :</label>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="User's password" name="pwd">  
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block col-sm-12">Send</button>
    </form>
    <?php
        include 'dbLogin.php';
        include 'functions.php';
        if(isset($_POST['name']) && isset($_POST['firstName']) && isset($_POST['mail'])
        && isset($_POST['pwd']) && !empty($_POST['name']) && !empty($_POST['firstName'])
        && !empty($_POST['mail']) && !empty($_POST['pwd'])) {
            $name = $_POST['name'];
            $firstName = $_POST['firstName'];
            $mail = $_POST['mail'];
            $pwd = md5($_POST['pwd']);
            addUser($db, $name, $firstName, $mail, $pwd);
        } else if (!isset($_GET['error'])) {
            echo "<div class='alert alert-warning mt-4' role='alert'>Please complete the form.</div>";
        }

        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger mt-4' role='alert'>This user already exists.</div>";
            echo "<script>setTimeout(()=>{document.location.href='addUser.php';}, 1500);</script>";
        }
    ?>
    </div>
</body>
</html>