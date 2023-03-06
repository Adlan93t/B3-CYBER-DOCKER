<?php
    require_once('./functions.php');

    if (isset($_POST['send'])) {
      

        $link = connectDB();

      
        $email = $_POST['email'];
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
        $sth = $link->prepare($sql);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->execute();
        $count = $sth->fetchColumn();

    
        if ($count > 0) {
            echo "Cette adresse email existe déjà. Veuillez vous connecter ou essayer avec une autre adresse ";
            exit;
        }


        $password = $_POST['password'];
        $sql = 'INSERT INTO users (`email`, `password`) VALUES (:email, :password)';
        $sth = $link->prepare($sql);
        $sth->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: login.php");
    }
?>


<style>
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 5px;
    }
    input[type="email"], input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: none;
        background-color: #e9e9e9;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #3e8e41;
    }
    a {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #555;
    }
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form method="POST">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            value="" 
            placeholder="Saisir votre email" 
            required
        />
        <label for="email2">Confirmation</label>
        <input 
            type="email" 
            name="email2" 
            id="email2" 
            value="" 
            placeholder="Confirmez votre email" 
            required
        />

        <label for="password">Mot de passe</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            value="" 
            placeholder="Saisir votre mot de passe" 
            required
        />
        <label for="password">Confirmation</label>
        <input 
            type="password" 
            name="password2" 
            id="password2" 
            value="" 
            placeholder="Confirmer votre mot de passe" 
            required
        />
        <input type="submit" value="Créer" name="send" />
    </form>
    <a href="login.php">Vous avez déjà un compte ?</a>
</body>
</html>