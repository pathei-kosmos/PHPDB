<?php
    function addUser($db, $name, $firstName, $mail, $pwd) {
        $reqRead = $db->prepare('SELECT * FROM users');
        $reqRead->execute();
        $alreadyExistent = false;

        while ($data = $reqRead->fetch()) {
            $mailDB = $data['mail_user'];
            if ($mail == $mailDB) {
                $alreadyExistent = true;
                header('Location: addUser.php?error');
            } 
        }

        if ($alreadyExistent != true) {
            try {
                $req = $db->prepare('INSERT INTO users(name_user, firstName_user, mail_user, pwd_user) 
                VALUES(:name_user, :firstName_user, :mail_user, :pwd_user)');
                $req->execute(array (
                    'name_user' => $name,
                    'firstName_user' => $firstName,
                    'mail_user' => $mail,
                    'pwd_user' => $pwd
                ));
                echo "<div class='alert alert-success mt-4' role='alert'>User created.</div>";
            } catch(Exception $e) {
                die('Erreur : '.$e->getMessage());
            }
        } 
    }

    function displayUsers($db) {
        try {
            $req = $db->prepare('SELECT * FROM users');
            $req->execute();
            while ($data = $req->fetch()) {
                $id = $data['id_user'];
                $name = $data['name_user'];
                $firstName = $data['firstName_user'];
                $mail = $data['mail_user'];
                echo "<li class='list-group-item ligrid'><span>$name</span><span>$firstName</span><span>$mail</span><a href='modifyUser.php?id=$id'>✏️</a></li>";
            }
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    function userEditor($db, $id) {
        if (!isset($id)) {
            header('Location: displayUsers.php?modify');
        }

        try {
            $req = $db->prepare('SELECT * FROM users WHERE id_user = :id_user');
            $req->execute(array (
                'id_user' => $id
            ));
            while ($data = $req->fetch()) {
                $id = $data['id_user'];
                $name = $data['name_user'];
                $firstName = $data['firstName_user'];
                $mail = $data['mail_user'];
                $formatName = 
                "<label for='name'>Last Name :</label>
                <div class='div'>
                    <div class='input-group'>
                        <input type='text' class='form-control' placeholder=\"User's last name\" name='name'>
                        <div class='input-group-append'>
                            <span class='input-group-text' id='basic-addon2'>Current value : %s</span>
                        </div>  
                    </div>
                </div>";
            echo sprintf($formatName, $name);
                $formatFirstName = 
                "<div class='div'>
                <label for='firstName'>First Name :</label>
                <div class='input-group'>
                    <input type='text' class='form-control' placeholder=\"User's first name\" name='firstName'> 
                        <div class='input-group-append'>
                            <span class='input-group-text' id='basic-addon2'>Current value : %s</span>
                        </div> 
                    </div>
                </div>";
            echo sprintf($formatFirstName, $firstName);
                $formatMail = 
                "<div class='div'>
                <label for='mail'>Email :</label>
                <div class='input-group'>
                    <input type='email' class='form-control' placeholder=\"User's email\" name='email'> 
                        <div class='input-group-append'>
                            <span class='input-group-text' id='basic-addon2'>Current value : %s</span>
                        </div> 
                    </div>
                </div>";
            echo sprintf($formatMail, $mail);
            }
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    function modifyUser($db, $id, $name, $firstName, $mail) {
        try {
            $req = $db->prepare("UPDATE users 
            SET name_user = :name_user, firstName_user = :firstName_user, mail_user = :mail_user
            WHERE id_user = :id_user");
            $req->execute(array (
                'name_user' => $name,
                'firstName_user' => $firstName,
                'mail_user' => $mail,
                'id_user' => $id
            ));
            echo "<div class='alert alert-success mt-4' role='alert'>User updated.</div>";
            echo "<script>setTimeout(()=>{document.location.href='displayUsers.php';}, 1500);</script>";
        }
        catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
?>
