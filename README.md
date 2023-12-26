# trapta_score_php_simple
code PHP à installer sur le serveur d'hébergement de diffusion des scores en ligne pour TRAPTA
cette version fonctionne avec TRAPTACloud_simple: diffusion pour un seul concours à la fois


Vous devez avoir un site web personnel qui peut héberger des pages php et les afficher hors du mode TLS (affichage http:// et non https://). Aucune base de données n'est nécessaire.

et copiez les fichiers du repertoire /traptascore dans un répertoire de votre site.

Par exemple si votre site est http://www.monsite.fr, vous devrez avoir la liste des fichiers dans http://www.monsite.fr/traptascore
Avant de copier les fichiers sur votre site, éditez le fichier passwordcheck.php et remplacez le mot "trapta"par votre propre mot de passe.

La ligne:
$passwordcheck = "trapta";
devra ressembler à:
$passwordcheck = "monmotdepasse";
