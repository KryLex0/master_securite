<div class="header">
    <link rel="stylesheet" href="devoir_securite.css">
    <h1 class="title">Inscription</h1>

    <div class="formulaire">
        <form method="POST" action="formulaire_creation_compte.php" id="pageConnexion">



            <table>
                <tbody>
                    <tr>
                        <td><label class="label_name">Identifiant</label></td>
                        <td><input type="text" name="login" placeholder="nom d'utilisateur" required/></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Mot de passe</label></td>
                        <td><input type="password" name="password" placeholder="**********" required/></td>
                    </tr>
                    <tr>
                        <td><label class="label_name">Confirmez votre mot de passe</label></td>
                        <td><input type="password" name="password_confirmation" placeholder="**********" required/></td>
                    </tr>
                </tbody>
            </table>

            <a href="accueil.php" style="background:none;color:blue;text-decoration: underline;">Déjà un compte? Cliquez ici!</a>

            <input style="margin-top: 70px;" type="submit" value="Inscription"/>
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