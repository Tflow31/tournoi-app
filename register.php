<?php
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ":username" => $username,
            ":email" => $email,
            ":password" => $password
        ]);

        $message = "Inscription réussie 🎉";
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>

<h2>Créer un compte</h2>

<p><?= $message ?></p>

<form method="POST">
    <input type="text" name="username" placeholder="Nom" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>

    <button type="submit">S'inscrire</button>
</form>

<a href="login.php">Déjà un compte ?</a>

</body>
</html>