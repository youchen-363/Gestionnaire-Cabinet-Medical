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
    
    if (isset($_POST['disconnect'])){
        session_unset();
        header("Location: ./identification.php");
    }
?>

<?php 
    // obtenir la next value de idUsager
    $idUsager = nextValeurUsager();
    
    $nomMed = "";
    $res = getAllMedecins();

    // initialisation des variables 
    $cv = $nom = $pnom = $adr = $cp = $ville = $numSecu = $cpNais = $villeNais = $dateNais = $idMedecin = "";

    if (isset($_POST['submit'])){
        // if (!empty($_POST['nom'])){
            // convertir de nom a id 
            // sur l'appli, nom med est affiche mais dans la bd cest id med 
            $noms = explode(" ", $_POST['nomMedecin']);
            $idMedecin = getIdMedecinByNomEtPrenom($noms[0], $noms[1]);
        // }
        // verifier tous les champs sont remplis
        if (empty($_POST['civilite']) || empty($_POST['numSecu']) || empty($_POST['nom']) || empty($_POST['prenom']) ||
            empty($_POST['adr']) || empty($_POST['cp']) || empty($_POST['cpn']) || empty($_POST['ville']) ||
            empty($_POST['villeNaissance']) || empty($_POST['dateNaissance'])) {
            echo '<script>alert("Il faut remplir tous les informations !")</script>';    
        } else { 
            $cv = htmlspecialchars($_POST['civilite']);
            $nom = htmlspecialchars($_POST['nom']);
            $pnom = htmlspecialchars($_POST['prenom']);
            $adr = htmlspecialchars($_POST['adr']);
            $cp = htmlspecialchars($_POST['cp']);
            $ville = htmlspecialchars($_POST['ville']);
            $numSecu = htmlspecialchars($_POST['numSecu']);
            $cpNais = htmlspecialchars($_POST['cpn']);
            $villeNais = htmlspecialchars($_POST['villeNaissance']);
            $dateNais = htmlspecialchars($_POST['dateNaissance']);

            // verifier la date chosi est inferieur a aujourdhui
            $dateNCheck = new DateTime($dateNais);
            $dateTdy = new DateTime();
            $ins = false;
            if ($dateNCheck <= $dateTdy){
                // inserer Usager dans la bd 
                $ins = insertUsager($cv, $numSecu, $nom, $pnom, $adr, $cp, $cpNais, $ville, $villeNais, $dateNais, $idMedecin);
                if ($ins) {
                    header('Location: usager.php');
                } else {
                    echo "Erreur lors de l'ajout du usager.";
                }
            } else {
                echo "<br><br>Date de naissance doit etre inferieur a la date d'aujourd'hui.";
            }   
        }
    }

    $linkpdo = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="i18n/datepicker-fr.js"></script>

    <link rel="stylesheet" href="../css/style.css">
    <title>Enregistrement d'un usager - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
</head>
<body class="d-flex flex-column justify-content-between">
    <!-- Affichage du header -->
    <?php 
        setHeader("usager_saisie.php",$_SESSION['user']);
    ?>

    <main class="flex-grow-1">
        <div class="d-flex flex-column align-items-center mx-auto usager-content justify-content-start" style="width: 65%; height: 100%;">
            <h2 class="my-5 fw-bold">Enregistrement d'un nouvel usager</h2>

            <div class="d-flex flex-column justify-content-between" style="width: 55%;">
                <form method="post" action="usager_saisie.php">
                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations personnelles</h4>

                    <input type="text" name="nom" id="nom" value="<?= $nom?>" class="form-control mb-3" placeholder="Nom" pattern="^[^\s]+$" title="Nom sans espace" required>
                    <input type="text" name="prenom" id="prenom" value="<?= $pnom?>" class="form-control mb-3" placeholder="Prénom" pattern="^[^\s]+$" title="Prenom sans espace" required>
                    <div class="d-flex flex-row mb-4">
                        <div class="form-check me-5">
                            <input class="form-check-input" type="radio" value="M" name="civilite" id="monsieur"
                                <?php if (isset($_POST['civilite']) && $_POST['civilite'] == 'M') echo 'checked'; ?>> 
                            <label class="form-check-label" for="monsieur">M.</label>
                        </div>
                        <div class="form-check me-5">
                            <input class="form-check-input" type="radio" value="Mme" name="civilite" id="madame"
                                <?php if (isset($_POST['civilite']) && $_POST['civilite'] == 'Mme') echo 'checked'; ?>> 
                            <label class="form-check-label" for="madame">Mme.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Autre" name="civilite" id="autre"
                                <?php if (isset($_POST['civilite']) && $_POST['civilite'] == 'Autre') echo 'checked'; ?>> 
                            <label class="form-check-label" for="autre">Autre</label>
                        </div>
                    </div>
                    <input type="text" name="adr" id="adr" value="<?= $adr?>" class="form-control mb-3" placeholder="Adresse" required>
                    <input type="text" name="ville" id="ville" value="<?= $ville?>" class="form-control mb-3" placeholder="Ville" required>
                    <input type="text" name="cp" id="cp" value="<?= $cp?>" maxlength="5" pattern="[0-9]{5}" title="Exact 5 nombres" class="form-control mb-3" placeholder="Code Postal" required style="width: 200px;">

                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations de naissance</h4>
                    <div class="input-group mb-3" style="width: 200px;">
                        <input type="date" name="dateNaissance" value="<?= $dateNais?>" class="form-control datepicker py-1" placeholder="date" style="border-right: 1px solid;" required/>
                    </div>
                    <input type="text" name="villeNaissance" id = "villeNaissance" value="<?= $villeNais?>" class="form-control mb-3" placeholder="Ville" required>
                    <input type="text" name="cpn" id="cpn" value="<?= $cpNais?>" class="form-control mb-3" placeholder="Code Postal" required style="width: 200px;" maxlength="5" pattern="[0-9]{5}" title="Exact 5 nombres">
                    
                    <h4 class="formPart fst-italic py-4 fw-semibold">Informations médicales</h4>
                    <input type="text" name="numSecu" id="numSecu" value="<?= $numSecu?>" class="form-control mb-3" placeholder="Numéro de sécurité sociale" required maxlength=13 pattern="[0-9]{13}" title="Exact 13 nombres" style="width: 400px;">
                    <select name="nomMedecin" id="nomMedecin" class="form-control mb-3" placeholder="Médecin référent">
                    <option value=''> </option>
                        <?php foreach($res as $result) : ?>
                        <?php $value = htmlspecialchars($result['nom'] . " " . $result['prenom']);?>
                    <option value='<?=$value?>'> <?=$value?> </option>
                        <?php endforeach;?>  
                    </select>
                    <div class="d-flex flex-row justify-content-between pt-4 my-5">
                        <a class="btn btn-secondary" style="width: 8rem;" href="usager.php">Annuler</a>
                        <button type="submit" class="btn btn-bd-primary"  style="width: 23rem;" name="submit">Enregistrer le nouvel usager</button>
                    </div>
                </form>
            </div>
            
        </div>
    </main>

    <!-- Affichage du header -->
    <?php 
        setFooter();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
    let pageActive = document.getElementById('usager-bar-full-screen');
        pageActive.style.backgroundColor = '#3EB1A8';
    </script>
        
</body>
</html>