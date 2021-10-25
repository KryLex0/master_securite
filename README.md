# master_securite
 Projet d'un formulaire de connexion/inscription sécurié
 
Langages utilisés: HTML/CSS, PHP, JavaScript
Développé sur VisualCodeStudio


Le fichier "fichier_bdd_mysql.sql" est la base de donnée à importer sur mysql.
J'ai utilisé WAMP pour réaliser ce projet ainsi que l'éditeur VisualCodeStudio.

La page principale à ouvrir est le fichier "accueil.php" sur laquelle se trouve la page d'identification ainsi qu'un bouton permettant de se créer un compte. Pour la création de compte, une nouvelle page s'ouvrire, "formulaire_creation_compte.php". Sur cette page se trouve un nom d'utilisateur à entrer ainsi que 2 inputs pour entrer et vérifier le mot de passe.

Cette page comporte une vérification en JavaScript qui vérifie que le mot de passe et la confirmation sont identique ainsi que la longueur du mot de passe qui doit être supérieur à 6. Egalement, dans le nom d'utilisateur, les espaces sont remplacés par des "-" ainsi que les espaces qui sont supprimés des 2 inputs de mot de passe.
