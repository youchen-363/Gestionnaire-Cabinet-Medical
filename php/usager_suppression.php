<?php
    include('header.php');
    include('footer.php');
    include ('session.php');
    include('connection.php');
    include("function_usager.php");
    include("function_medecin.php");

    if (empty($_SESSION['user'])){
        header("Location: identification.php");
    }
    
    disconnect();
    if (isset($_POST['disconnect'])){
        unsetSessions();
    }

?>

<?php

    $idU = $cv = $nom = $pnom = $adr = $cp = $ville = $numSecu = $cpNais = $villeNais = $dateNais = $nomMed = "";

    // recuperer toutes les informations passes de la page accueil
    $idU = htmlspecialchars($_GET['idU']);
    $cv = htmlspecialchars($_GET['cv']);
    $nom = htmlspecialchars($_GET['nom']);
    $pnom = htmlspecialchars($_GET['pnom']);
    $adr = htmlspecialchars($_GET['adr']);
    $cp = htmlspecialchars($_GET['cp']);
    $ville = htmlspecialchars($_GET['ville']);
    $numSecu = htmlspecialchars($_GET['numSecu']);
    $cpNais = htmlspecialchars($_GET['cpN']);
    $villeNais = htmlspecialchars($_GET['villeN']);
    $dateNais = htmlspecialchars($_GET['dateN']);
    $nomMed = htmlspecialchars($_GET['med']);

    $meds = getAllMedecins();

    if (isset($_GET['valider'])){
        $updt = deleteUsagerParId($idU);
        if ($updt == true){
            echo "Suppression usager succès";
            // aller a la page affichage
            header("Location: usager.php");
        } else {
            echo "Erreur de suppression";
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
    <title>Suppression d'un usager - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
</head>
<body class="d-flex flex-column justify-content-between">
    <?php
        setHeader("usager_suppression.php", $_SESSION['user']);
    ?>

    <main class="flex-grow-1">
        <div class="d-flex flex-column align-items-center mx-auto usager-content justify-content-start" style="width: 65%; height: 100%;">
            <h2 class="my-5 fw-bold">Suppression de l'usager <?= $pnom?> <?= $nom?></h2>

            <div class="d-flex flex-column justify-content-between" style="width: 55%;">
                <form action="#">
                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations personnelles</h4>

                    <input type="hidden" name="idU" id="idU" value="<?= $idU ?>"> 
                    <input type="text" class="form-control mb-3" name="nom" id="nom" value="<?= $nom?>" placeholder="Nom" disabled>
                    <input type="text" class="form-control mb-3" name="pnom" id="prenom" value="<?= $pnom?>" placeholder="Prénom" disabled>
                    <div class="d-flex flex-row mb-4">
                        <div class="form-check me-5">
                            <input class="form-check-input" type="radio" value="M" name="cv" id="monsieur" <?php if ($cv == 'M') echo 'checked'; ?> disabled >
                            <label class="form-check-label" for="monsieur">M.</label>
                        </div>
                        <div class="form-check me-5">
                            <input class="form-check-input" type="radio" value="Mme" name="cv" id="madame" <?php if ($cv == 'Mme') echo 'checked'; ?> disabled >
                            <label class="form-check-label" for="madame">Mme.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Autre" name="cv" id="autre" <?php if ($cv == 'Autre') echo 'checked'; ?> disabled >
                            <label class="form-check-label" for="autre">Autre</label>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-3" name="adr" id="adr" value="<?= $adr?>"  placeholder="Adresse" disabled >
                    <input type="text" class="form-control mb-3" name="ville" id="ville" value="<?= $ville?>" placeholder="Ville" disabled >
                    <input type="text" class="form-control mb-3" name="cp" id="cp" value="<?= $cp?>" placeholder="Code Postal" disabled style="width: 6rem;">

                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations de naissance</h4>
                    
                    <div class="input-group mb-3" style="width: 200px;">
                        <input type="date" id="date" name="dateN" value="<?= $dateNais?>" class="form-control datepicker py-1" style="border-right: 1px solid;" disabled  />
                    </div> 
                    <input type="text" class="form-control mb-3" name="villeN" id = "villeNaissance" value="<?= $villeNais?>" placeholder="Ville de naissance" disabled >
                    <input type="text" class="form-control mb-3" name="cpN" id="cpn" value="<?= $cpNais?>" placeholder="Code Postal de naissance" disabled style="width: 12rem;">
                    
                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations médicales</h4>
                    <input type="text" class="form-control mb-3" name="numSecu" id="numSecu" value="<?= $numSecu?>" placeholder="Numéro de sécurité sociale" disabled >
                    <select name="med" id="nomMedecin" class="form-control mb-3" placeholder="Médecin référent" disabled >
                        <!-- pour laisser un choix "sans medecin prefere" -->
                        <option value=''></option>
                        <?php foreach($meds as $med) : ?>
                            <?php $value = htmlspecialchars($med['nom'] . " " . $med['prenom'])?>
                            <option value='<?=$value?>' <?= ($value == $nomMed) ? 'selected' : '' ?>> <?=$value?> </option>
                        <?php endforeach;?>  
                    </select>

                    <div class="d-flex flex-row justify-content-between pt-4 my-5">
                        <a class="btn btn-secondary" style="width: 30%;" href="usager.php">Annuler</a>
                        <button type="submit" name="valider" value="Valider" class="btn btn-bd-primary"  style="width: 60%;">Enregistrer la suppression</button>
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
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap5'
        });

        var monInput = document.getElementById("nom");
        var date = document.getElementById("dateNaissance");

        // Ajoutez un écouteur d'événements sur l'événement "input"
        monInput.addEventListener("input", function() {
            // Cette fonction sera appelée à chaque changement dans le champ de texte
            var contenu = date.value;
            console.log("Contenu de l'input :", contenu);
        });

        let pageActive = document.getElementById('usager-bar-full-screen');
        pageActive.style.backgroundColor = '#3EB1A8';
    </script>
</body>
</html>