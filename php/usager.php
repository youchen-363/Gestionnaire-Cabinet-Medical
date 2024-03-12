<?php 
    include('header.php');
    include('footer.php');
    include ('session.php');
    include('connection.php');
    include("function_usager.php");
    include("function_medecin.php");
    include("poo_usager.php");

    if (empty($_SESSION['user'])){
        header("Location: identification.php");
    }
    
    if (isset($_POST['disconnect'])){
        session_unset();
        header("Location: ./identification.php");
    }
?>

<?php
    // s'il n'y a pas de text recherche, afficher tous les usagers
    $motcle = "";
    if ($motcle == ""){
        // obtenir tous les usagers
        $usgs = getAllUsagers();
    }

    // si bouton rechercher est clique
    if (isset($_POST['motcle'])){
        // obtenir la "value" de input name="motcle"
        $motcle = $_POST['motcle'];
        // obtenir un usager par nom 
        $usgs = getUsagerByNom($motcle);
    }

    // pour supprimer un usager
    if (isset($_POST['id_usager'])) {
        // obtenir la "value" de input name="id_usager"
        $idUsager = $_POST['id_usager'];  
        // appeler fonction pour supprimer 
        deleteUsagerParId($idUsager);
        $usgs = getAllUsagers();
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Usagers - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>
</head>
<body class="d-flex flex-column justify-content-between">
    <!-- Affichage du header -->
    <?php 
        setHeader('usager.php',$_SESSION['user']);
    ?>

    <!-- contenu de la page -->
    <main class="flex-grow-1">
        <div class="d-flex flex-column align-items-center mx-auto usager-content justify-content-start" style="width: 65%; height: 100%;">
            <div class="d-flex flex-row justify-content-between my-5" style="width: 85%;">
                <form method="post" action="usager.php" id="search_form" style="width: 50%;">
                    <input type="search" name = "motcle" id="motcle" value="<?php echo htmlspecialchars("$motcle") ?>"  placeholder="Recherchez un usager par nom, prénom" class="rounded-pill border border-0 p-2 ps-4" style="width: 100%;" >
                </form>
                <a class="btn btn-secondary pe-4 rounded-pill" href="usager_saisie.php">
                    <svg class="ms-1 me-3" xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                        <path d="M3 10H10M10 10H17M10 10V17M10 10V3" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Enregistrer un usager
                </a>
            </div>
            <div style="width: 85%; margin-bottom:10%;">
                <?php 
                    if (count($usgs) > 0){
                        echo '
                        <div class="accordionHeader d-flex flex-row justify-content-between align-items-center">
                            <h5 class="my-2 ms-4">NOM</h5>
                            <h5 class="mb-0">Prénom</h5>
                            <h5 class="mb-0">Médecin référent</h5>
                            <h5></h5>
                        </div>
                        <div class="accordion" id="accordionExample">';
                        foreach ($usgs as $row){
                            $med = getNomPrenomMedecinById($row['idMedecin']);
                            $usager = new Usager($row['idUsager'], $row['nom'], $row['prenom'], $row['civilite'], $row['numSecu'], $row['adresse'], $row['ville'], $row['cp'], $row['dateNaissance'], $row['cpNaissance'], $med, $row['villeNaissance']);
                            $usager->afficherInfos();
                        }
                        echo'</div>';
                    } else if ($motcle != ""){
                        echo 
                        '<div class="d-flex flex-row align-items-center justify-content-center" style="height:100px; width:100%; border-radius: 15px; border: 1px solid #D25050;background: #D25050;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                <path d="M23.743 4.58111C21.8481 2.68616 19.4338 1.39569 16.8054 0.872877C14.177 0.350063 11.4527 0.61839 8.97681 1.64393C6.50095 2.66946 4.38479 4.40615 2.89595 6.63436C1.4071 8.86258 0.612429 11.4823 0.612429 14.1621C0.612429 16.842 1.4071 19.4616 2.89595 21.6899C4.38479 23.9181 6.50095 25.6548 8.97681 26.6803C11.4527 27.7058 14.177 27.9742 16.8054 27.4513C19.4338 26.9285 21.8481 25.6381 23.743 23.7431C25.0086 22.4891 26.0132 20.9967 26.6988 19.3522C27.3843 17.7078 27.7373 15.9438 27.7373 14.1621C27.7373 12.3805 27.3843 10.6164 26.6988 8.97197C26.0132 7.3275 25.0086 5.83515 23.743 4.58111ZM17.646 19.3881L14.162 15.9041L10.678 19.3881C10.447 19.6191 10.1337 19.7489 9.80701 19.7489C9.48032 19.7489 9.16701 19.6191 8.93601 19.3881C8.70501 19.1571 8.57523 18.8438 8.57523 18.5171C8.57523 18.1904 8.70501 17.8771 8.93601 17.6461L12.42 14.1621L8.93601 10.6781C8.70501 10.4471 8.57523 10.1338 8.57523 9.80711C8.57523 9.48042 8.70501 9.16711 8.93601 8.93611C9.16702 8.7051 9.48032 8.57533 9.80701 8.57533C10.1337 8.57533 10.447 8.7051 10.678 8.93611L14.162 12.4201L17.646 8.93611C17.877 8.7051 18.1903 8.57533 18.517 8.57533C18.8437 8.57533 19.157 8.7051 19.388 8.93611C19.619 9.16711 19.7488 9.48042 19.7488 9.80711C19.7488 10.1338 19.619 10.4471 19.388 10.6781L15.904 14.1621L19.388 17.6461C19.619 17.8771 19.7488 18.1904 19.7488 18.5171C19.7488 18.8438 19.619 19.1571 19.388 19.3881C19.157 19.6191 18.8437 19.7489 18.517 19.7489C18.1903 19.7489 17.877 19.6191 17.646 19.3881Z" fill="white"/>
                            </svg>
                            <h6 style="color:#FFF;; margin-left: 10%; width: 50%;">Aucun usager ayant pour nom ou prénom <span style="font-weight:bold;">'.$_POST['motcle'].'</span> n\'a été trouvé</h5>
                        </div>';
                    } else {
                        echo 
                        '<div class="d-flex flex-row align-items-center justify-content-center" style="height:100px; width:100%; border-radius: 15px; border: 1px solid #3EB1A8;background: #3EB1A8;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                <path d="M14 28C6.2678 28 0 21.7322 0 14C0 6.2678 6.2678 0 14 0C21.7322 0 28 6.2678 28 14C28 21.7322 21.7322 28 14 28ZM13.0256 23.0524C13.9076 23.0524 14.8904 22.6492 16.1 21.0112L17.3754 19.3032C17.4127 19.2533 17.4396 19.1964 17.4546 19.1359C17.4696 19.0754 17.4723 19.0126 17.4627 18.951C17.453 18.8894 17.4312 18.8304 17.3984 18.7774C17.3656 18.7244 17.3226 18.6785 17.2718 18.6424C17.1644 18.5666 17.0327 18.5332 16.9022 18.5487C16.7716 18.5642 16.6514 18.6275 16.5648 18.7264L14.4998 21.077C14.4523 21.131 14.3888 21.1684 14.3185 21.1838C14.2482 21.1992 14.1749 21.1917 14.1092 21.1624C14.0454 21.1344 13.9936 21.0848 13.9628 21.0223C13.9321 20.9598 13.9244 20.8884 13.9412 20.8208L16.5424 10.3964C16.5711 10.2828 16.5709 10.1638 16.5415 10.0503C16.5122 9.93683 16.4548 9.83256 16.3747 9.74708C16.2945 9.66161 16.1941 9.59767 16.0827 9.56117C15.9714 9.52467 15.8526 9.51677 15.7374 9.5382L11.0474 10.3964C10.9552 10.4133 10.8698 10.4564 10.8013 10.5204C10.7328 10.5844 10.6841 10.6667 10.661 10.7576L10.5406 11.2252C10.5273 11.277 10.5261 11.3311 10.537 11.3834C10.5479 11.4358 10.5707 11.4849 10.6035 11.5271C10.6364 11.5692 10.6784 11.6033 10.7265 11.6267C10.7746 11.6501 10.8274 11.6622 10.8808 11.662H13.3028L11.2364 19.9528C11.1608 20.2804 11.0348 20.8348 11.0348 21.238C11.0348 22.1704 11.5892 23.0524 13.0256 23.0524ZM15.5876 8.302C16.5704 8.302 17.3264 7.7224 17.528 6.8404C17.5784 6.6388 17.6036 6.412 17.6036 6.2608C17.6036 5.5552 17.0492 4.9 16.016 4.9C15.0332 4.9 14.2772 5.4796 14.0756 6.3616C14.0288 6.55137 14.0035 6.74578 14 6.9412C14 7.6468 14.5544 8.302 15.5876 8.302Z" fill="white"/>
                            </svg>
                            <h6 style="color:#FFF;; margin-left: 10%; width: 50%;">Il n\'y a pas d\'usager inscrit dans votre cabinet, veuillez en ajouter afin de pouvoir enregistrer vos futures consultations</h5>
                        </div>';
                    } 
                ?>
            </div>
        </div>
    </main>

    <!-- Affichage du footer -->
    <?php
        setFooter();
    ?>

    <!-- Librairies bootstrap de mise en forme -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- interception de la touche entrée sur la connection pour se connecter -->
    <script>
        document.getElementById('motcle').addEventListener('keyup', function (e) {
            if (e.keyCode === 13) {
                document.getElementById('search_form').submit();
            }
        });

        let pageActive = document.getElementById('usager-bar-full-screen');
        pageActive.style.backgroundColor = '#3EB1A8';
    </script>
</body>
</html>