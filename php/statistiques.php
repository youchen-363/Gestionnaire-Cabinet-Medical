<?php 
    include('header.php');
    include('footer.php');
    include ('session.php');
    include('connection.php');
    include("function_usager.php");
    include("function_medecin.php");
    include("function_consultation.php");
    include("function_statistique.php");
    
    if (empty($_SESSION['user'])){
        header("Location: identification.php");
    }
    
    if (isset($_POST['disconnect'])){
        session_unset();
        header("Location: ./identification.php");
    }

    $usgs = getAllUsagers();
    $meds = getAllMedecins();
    $ages = calculerAge($usgs);
    
    $cons = getAllConsultations(); 
    $nbMed = count(getAllMedecins());
    $dureeMeds = calculerDureeMeds($cons, $nbMed);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Statistiques - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>
</head>
<body class="d-flex flex-column justify-content-between">
    <?php
        setHeader('statistiques.php', $_SESSION['user']);
    ?>
<body class="d-flex flex-column justify-content-between">
<main class="flex-grow-1">
        <div class="d-flex flex-column align-items-center mx-auto usager-content justify-content-start" style="width: 65%; height: 100%;">
            <h2 class="my-5 fw-bold">Statistiques</h2>

            <div class="d-flex flex-column justify-content-between" style="width: 85%;">
                <div class="align-items-center mb-5">
                    <div class="accordionHeader row justify-content-between">
                        <h5 class="col my-3 text-center">Tranche d'age</h5>
                        <h5 class="col my-3 text-center">Nombre d'hommes</h5>
                        <h5 class="col my-3 text-center">Nombre de femmes</h5>
                        <h5 class="col my-3 text-center">Autre</h5>
                    </div>
                    <div class="border accordion-item row justify-content-between">
                        <h5 class="col my-3 text-center">Moins de 25 ans</h5>
                        <h5 class="col my-3 text-center"><?= $ages['inf']['homme']?></h5>
                        <h5 class="col my-3 text-center"><?= $ages['inf']['femme']?></h5>
                        <h5 class="col my-3 text-center"><?= $ages['inf']['autre']?></h5>
                    </div>
                    <div class="border accordion-item row justify-content-between">
                        <h5 class="col my-3 text-center">Entre 25 et 50 ans</h5>
                        <h5 class="col my-3 text-center"><?= $ages['mid']['homme']?></h5>
                        <h5 class="col my-3 text-center"><?= $ages['mid']['femme']?></h5>
                        <h5 class="col my-3 text-center"><?= $ages['mid']['autre']?></h5>
                    </div>
                    <div class="border accordion-item row justify-content-between">
                        <h5 class="col my-3 text-center">Plus de 50 ans</h5>
                        <h5 class="col my-3 text-center"><?= $ages['sup']['homme']?></h5>
                        <h5 class="col my-3 text-center"><?= $ages['sup']['femme']?></h5>
                        <h5 class="col my-3 text-center"><?= $ages['sup']['autre']?></h5>
                    </div>
                </div>

                <div class="align-items-center mb-5">
                    <div class="accordionHeader row justify-content-between">
                        <h5 class="col my-3 text-center">Médecin</h5>
                        <h5 class="col my-3 text-center">Nombre d'heures</h5>
                    </div>
                    <?php
                        foreach($meds as $med){
                            $intituleMed = $med['prenom'].' '.strtoupper($med['nom']);
                            $nomMed = $med['nom'];
                            $heure = 0;
                            if (array_key_exists($nomMed, $dureeMeds)){
                                $heure = heureToHeureMinute($dureeMeds[$nomMed]);
                            }
                            echo'
                                <div class="border accordion-item row justify-content-between">
                                    <h5 class="col my-3 text-center">'.$intituleMed.'</h5>
                                    <h5 class="col my-3 text-center">'.$heure.'</h5>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
        setFooter();
    ?>
    <script>
        let pageActive = document.getElementById('statistiques-bar-full-screen');
        pageActive.style.backgroundColor = '#3EB1A8';
    </script>
</body>
</html>