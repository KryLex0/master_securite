<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="securite.js"></script>
<link rel="stylesheet" href="devoir_securite.css">



<div class="header">
    <img src="login.png" class="centerImg">
    <h1 class="title">Connexion</h1>

    <div class="formulaire">
        <form method="POST" action="accueil.php" id="pageConnexion">

            <table class="inputData">
                <tbody>
                    <tr>
                        <td><label class="label_name">Identifiant</label></td>
                        <td><input type="text" id="login" name="login" placeholder="nom d'utilisateur" required/></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Mot de passe</label></td>
                        <td><input type="password" id="password" name="password" placeholder="**********" required/></td>
                    </tr>
                    <tr>
                        <td><a href="formulaire_creation_compte.php" style="background:none;color:blue;text-decoration: underline;">Pas de compte? Cliquez ici!</a></td>
                        <td><input style="margin: 10px;" type="submit" value="Connexion"/></td>
                        <td><button style="margin: 10px;" type="reset">Vider saisie</button></td>
                    </tr>
                </tbody>
            </table>

        </form>
    </div>
</div>



<?php




// Vérifie qu'il provient d'un formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=localhost;dbname=master_securite;charset=utf8', 'root', 'root');

        $login = $_POST["login"];
        $password = $_POST["password"];
        
        $sqlQuery = "SELECT * FROM devoir1 WHERE login_user='".$login."'";

        $result = $mysqlClient->prepare($sqlQuery);
        $result->execute();
        $users = $result->fetchAll();

        if(isset($users[0])){
            if(password_verify($password, $users[0]['password_user'])){
                ?>
                    <script>
                        alert("Connexion réussi.");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        alert("Identifiant ou mot de passe incorrect. Veuillez recommencer.");
                    </script>
                <?php
            }
        }else{
            ?>
                <script>
                    alert("Aucun utilisateur n'existe. Veuillez créer un compte.");
                </script>
            <?php
        }
    
        unset($_POST);
        unset($_REQUEST);
        
        echo '<script language="javascript">window.location.href=""</script>';
    
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }


    
        
       

}
?>