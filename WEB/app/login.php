<?php
    require_once('./functions.php');

    if (isset($_POST['send'])) {
        // dd($_POST);

        $link = connectDB();
        $sql = 'SELECT * FROM users WHERE email=:email AND password = :password';

        $sth = $link->prepare($sql);
        $sth->execute([
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);

        $result = $sth->fetch();
        // dd($result);
        if ($result !== false && count($result) != 0) {
            $_SESSION['user'] = $result;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
      body {
  background-color: #f7f7f7;
  font-family: Arial, sans-serif;
}

form {
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="email"],
input[type="password"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: none;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #333;
  color: white;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #555;
}

a {
  display: block;
  margin-top: 20px;
  text-align: center;
  color: #333;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
    </style>
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

        <label for="password">Mot de passe</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            value="" 
            placeholder="Saisir votre mot de passe" 
            required
        />
        <input type="submit" value="Login" name="send" />
    </form>
    <a href="registration.php">Pas encore de compte ?</a>
</body>
</html>
