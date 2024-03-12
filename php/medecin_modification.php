<?php
    include('header.php');
    include('footer.php');
    include ('session.php');
    include('connection.php');
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
    $idM = $cv = $nom = $pnom = "";
    $idM = htmlspecialchars($_GET['idM']);
    $cv = htmlspecialchars($_GET['cv']);
    $nom = htmlspecialchars($_GET['nom']);
    $pnom = htmlspecialchars($_GET['pnom']);

    if (isset($_GET['valider'])){
        if (!(isset($_GET['cv']) and isset($_GET['nom']) and isset($_GET['pnom']) and isset($_GET['idM']))) {
                echo "<script> alert('Toutes les informations doivent être rempli !')</script>";
        }

        $ins = false;
        $updt = updateMedecin($idM, $cv, $nom, $pnom);
        if ($updt == true){
            header("Location: medecin.php");
        } else {
            echo "Mise à jour medecin ".$nom." erreur";
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
    <title>Modification d'un médecin - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>
</head>
<body class="d-flex flex-column justify-content-between">
    <?php
        setHeader('medecin_modification.php',$_SESSION['user']);
    ?>

    <main class="flex-grow-1">
        <div class="d-flex flex-column align-items-center mx-auto usager-content justify-content-start" style="width: 65%; height: 100%;">
            <h2 class="my-5 fw-bold">Modification du médecin <?= $pnom?> <?= $nom?></h2>

            <div class="d-flex flex-column justify-content-between" style="width: 55%;">
                <form action="#">
                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations personnelles</h4>
                    <input type="hidden" name="idM" value="<?= $idM ?>">
                    <input type="text" class="form-control mb-3" name="nom" id="nom" value="<?= $nom?>" placeholder="Nom" pattern="^[^\s]+$" title="Nom sans espace" required>
                    <input type="text" class="form-control mb-3" name="pnom" id="prenom" value="<?= $pnom?>" placeholder="Prénom" pattern="^[^\s]+$" title="Prenom sans espace" required>
                    <div class="d-flex flex-row mb-4">
                        <div class="form-check me-5">
                            <input class="form-check-input" type="radio" value="M" name="cv" id="monsieur" <?php if ($cv == 'M') echo 'checked'; ?>>
                            <label class="form-check-label" for="monsieur">M.</label>
                        </div>
                        <div class="form-check me-5">
                            <input class="form-check-input" type="radio" value="Mme" name="cv" id="madame" <?php if ($cv == 'Mme') echo 'checked'; ?>>
                            <label class="form-check-label" for="madame">Mme.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Autre" name="cv" id="autre" <?php if ($cv == 'Autre') echo 'checked'; ?>>
                            <label class="form-check-label" for="autre">Autre</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between pt-4 my-5">
                        <a class="btn btn-secondary" style="width: 30%;" href="medecin.php">Annuler</a>
                        <button type="submit" class="btn btn-bd-primary"  name="valider" value="Valider" style="width: 60%;">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
            
        </div>
    </main>

    <?php
        setFooter();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        let pageActive = document.getElementById('medecin-bar-full-screen');
        pageActive.style.backgroundColor = '#3EB1A8';
    </script>
</body>
</html>