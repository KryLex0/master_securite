<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="securite.js"></script>
<link rel="stylesheet" href="devoir_securite.css">

<div class="header">
    <h1 class="title">Inscription</h1>

    <div class="formulaire">
        <form method="POST" action="formulaire_creation_compte.php" id="pageConnexion">



            <table>
                <tbody>
                    <tr>
                        <td><label class="label_name">Identifiant</label></td>
                        <td><input type="text" id="login_signin" name="login_signin" placeholder="nom d'utilisateur" required/></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Mot de passe</label></td>
                        <td><input type="password" id="password_signin" name="password_signin" placeholder="**********" required/><td id="erreur-password" class="erreur"> Trop Court!</td></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Confirmez votre mot de passe</label></td>
                        <td><input type="password" id="password_confirmation_signin" name="password_confirmation_signin" placeholder="**********" required/><td id="erreur-conf" class="erreur"> Différents!</td></td>
                    </tr>
                    <tr>
                        <td><a href="accueil.php" style="background:none;color:blue;text-decoration: underline;">Déjà un compte? Cliquez ici!</a></td>
                        <td><input style="margin: 10px;" type="submit" value="Inscription" id="submitForm" onClick="return functionVerif()" disabled="true"/></td>
                        <td><button style="margin: 10px;" type="button" onClick="resetInputSignin()">Vider saisie</button></td>
                    </tr>
                </tbody>
            </table>

        </form>
    </div>
</div>



<?php


/*
//hash du mdp
$tempval = password_hash("test", PASSWORD_DEFAULT);


//ajout d'une donnee dans la bdd
$sqlQuery = "INSERT INTO devoir1(login_user, password_user) VALUES(
    'test', '".$tempval."'
)";
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();

echo("donnee bien ajouté \n");
*/

// Vérifie qu'il provient d'un formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=localhost;dbname=master_securite;charset=utf8', 'root', 'root');


        $login = $_POST["login_signin"];
        $password = password_hash($_POST["password_signin"], PASSWORD_DEFAULT);
        
        $sqlQuery = "SELECT * FROM devoir1 WHERE login_user='".$login."'";
        $result = $mysqlClient->prepare($sqlQuery);
        $result->execute();
        $users = $result->fetchAll();

        if(!isset($users[0])){
            $sqlQuery = "INSERT INTO devoir1(login_user, password_user) VALUES('".$login."', '".$password."')";
            $result = $mysqlClient->prepare($sqlQuery);
            $result->execute();
            //$users = $result->fetchAll();

            if($result){
                ?>
                <script>
                    alert("Utilisateur ajouté");
                </script>
                <?php
            }
        }else{
            ?>
                <script>
                    alert("Cet utilisateur possède déjà un compte.");
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