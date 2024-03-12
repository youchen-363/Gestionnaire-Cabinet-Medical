<?php 
    include('header.php');
    include('footer.php');
    include ('session.php');
    include('connection.php');
    include("function_usager.php");
    include("function_medecin.php");
    include("function_consultation.php");
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
    $duree = $medRef = $usg = $idUsager = $idMedecin = $date = $hour = "";

    if(isset($_GET['idUsager'])){
        $idUsager = $_GET['idUsager'];
        $usager = getUsagerById($idUsager);
        $usg = getNomUsagerById($idUsager);
        $idMedecin = getIdMedecinRefByIdUsager($idUsager);
        if(!(empty($idMedecin))){
            $medRef = getNomPrenomMedecinById($idMedecin);
        }
    }

    $meds = getAllMedecins();
    $usagers = getAllUsagers();

    if (isset($_POST['valider']) && !(empty($idUsager))){
        if (empty($_POST['nomMedecin']) || empty($_POST['date']) || empty($_POST['duree']) || empty($_POST['hour'])){
            echo 'Erreur';
        } 
        $noms = explode(" ", $_POST['nomMedecin']);
        $idMedecin = getIdMedecinByNomPrenom($noms[0], $noms[1]);
        $date = $_POST['date'];
        $hour = $_POST['hour'];
        $duree = $_POST['duree'];
        $heureObj = DateTime::createFromFormat('H:i', $hour);
        $hourComp = $heureObj -> format("H");
        $hourFormate = $heureObj->format('H:i:s');
        $heureFin = clone $heureObj;
        $heureFin -> modify("+$duree minutes"); 
        $heureFini = $heureFin -> format("H");
        $datetime = $date.' '.$hourFormate;

        $dateNCheck = new DateTime($date);
        $auj = new DateTime();

        if ($dateNCheck > $auj && $duree <= 180 && $duree >= 30 && (($hourComp>=9 && $hourComp<=12) || ($hourComp>=14 && $hourComp<=18)) && ($heureFini<=12 || ($heureFini>14 && $heureFini<=18)            )) {
            $ins = false;
            if (verifierNewConsultation($idMedecin, $datetime, $duree)){
                $ins = saisieConsultation($idMedecin, $datetime, $idUsager, $duree);
            } else {
                echo 'Creneau consultation disjoint pour ce medecin <br/>';
            }
            if ($ins){
                header("Location: consultation.php");
            } else {
                echo "Saisie de consultation echec";
            }
        } elseif ($dateNCheck < $auj) {
            echo "<br/>Date de consultation doit etre superieur a la date d'aujourd'hui";
        } elseif (!(($hourComp>=9 && $hourComp<=12) || ($hourComp>=14 && $hourComp<=18))) {
            echo "<br/>La consultation doit être entre 9h et 13h ou entre 14h30 et 18h !";
        } elseif (!($heureFini<=12 || ($heureFini>14 && $heureFini<=18))) { 
            echo "<br/>Heure fin dépasse l'heure de la pause ou de la fermature du cabinet !";
        } elseif ($duree > 180) {
            echo "<br/>La duree maximum est 3 heures !";
        } else {
            echo "<br/>La duree minimum est 30 minutes (0.5 heure) !";
        } 

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
    <title>Enregistrement d'une consultation - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
</head>
<body class="d-flex flex-column justify-content-between">
    <?php
        setHeader('consultation_saisie_donnees.php',$_SESSION['user']);
    ?>

    <main class="flex-grow-1">
        <div class="d-flex flex-column align-items-center mx-auto usager-content justify-content-start" style="width: 65%; height: 100%;">
            <div class="d-flex flex-column justify-content-between" style="width: 55%;">
                <h2 class="my-5 fw-bold" style=>Etape 2 : Enregistrement des données de la consultation pour <?php echo strtoupper($usager['nom']).' '.$usager['prenom'];  ?></h2>
                <form method="post" action=<?php echo 'consultation_saisie_donnees.php?idUsager='.$idUsager ?>>
                    <h4 class="formPart fst-italic py-4 fw-semibold">Créneau</h4>
                    <div class="input-group my-3" style="width: 200px;">
                        <input type="date" name="date" value="<?= $date ?>" class="form-control datepicker py-1" placeholder="date" style="border-right: 1px solid;" required/>
                    </div>
                    <input type="time" name="hour" id="hour" value="<?= $hour ?>" class=" input-group timepicker my-3 py-1" style="width: 200px; border-radius:5px; padding-left:10px; border: 1px solid black;" required/>
                    <input type="number" name="duree" id="duree" value="<?= $duree?>" min="30" max="180" step="30"  class="form-control my-3" placeholder="Durée en minutes" required style="width: 300px;">

                    <h4 class="formPart fst-italic py-4 mt-5 fw-semibold">Médecin</h4>
                    
                    <select name="nomMedecin" id="nomMedecin" class="form-control mb-3" placeholder="Médecin référent" required>
                        <option value=''> </option>
                            <?php foreach($meds as $result) : ?>
                            <?php $value = htmlspecialchars($result['nom'] . " " . $result['prenom']); ?>
                            <option value='<?=$value?>' <?= ($value == $medRef) ? 'selected' : '' ?>> <?=$value?> </option>
                            <?php endforeach;?>  
                    </select>

                    <div class="d-flex flex-row justify-content-between pt-4 my-5">
                        <a class="btn btn-secondary" style="width: 8rem;" href="consultation.php">Annuler</a>
                        <button type="submit" name="valider" id="valider" value="valider" class="btn btn-bd-primary"  style="width: 23rem;">Enregistrer la nouvelle consultation</button>
                    </div>
                </form>
            </div>
            
        </div>
    </main>

    <?php
        setFooter();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        let pageActive = document.getElementById('consultation-bar-full-screen');
        pageActive.style.backgroundColor = '#3EB1A8';
    </script>
</body>
</html>