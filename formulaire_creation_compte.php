<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="securite.js"></script>


<div class="header">
    <link rel="stylesheet" href="devoir_securite.css">
    <h1 class="title">Inscription</h1>

    <div class="formulaire">
        <form method="POST" action="formulaire_creation_compte.php" id="pageConnexion">



            <table>
                <tbody>
                    <tr>
                        <td><label class="label_name">Identifiant</label></td>
                        <td><input type="text" id="login" name="login" placeholder="nom d'utilisateur" required/></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Mot de passe</label></td>
                        <td><input type="password" id="password" name="password" placeholder="**********" required/><span id="erreur-password" class="erreur"> Trop Court!</span></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Confirmez votre mot de passe</label></td>
                        <td><input type="password" id="password_confirmation" name="password_confirmation" placeholder="**********" required/><span id="erreur-conf" class="erreur"> Différents!</span></td>
                    </tr>
                    <tr>
                        <td><a href="accueil.php" style="background:none;color:blue;text-decoration: underline;">Déjà un compte? Cliquez ici!</a></td>
                        <td><input style="margin: 10px;" type="submit" value="Inscription" id="submitForm" onClick="return functionVerif()" disabled="true"/></td>
                    </tr>
                </tbody>
            </table>

        </form>
    </div>
</div>


<script>
    $('#password').on('input', function() {
        var pass1 = document.getElementById("password").value
    });
    $('#password_confirmation').on('input', function() {
        var pass2 = document.getElementById("password_confirmation").value
    });

    


</script>

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


        $login = $_POST["login"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
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