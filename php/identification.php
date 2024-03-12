<?php
    session_start();
    $user = $mdp = "";
    if (isset($_POST['valider'])){
        $user = $_POST['username'];
        $mdp = $_POST['mdp'];
        if (!empty($user) and !empty($mdp)){
            if ($user == "admin" && $mdp == '$iutinfo'){
                $_SESSION['user'] = $_POST['username'];
                header("Location: ../index.php");
            }
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
    <link rel="shortcut icon" type="image/png" href="../img/cabinet.png"/>
    <title>Connexion - Cabi.Net</title>
    <link rel="shortcut icon" type="image/png" href="Logo_identification.png"/>
</head>
<body class="d-flex flex-column justify-content-between identification">

    <main class="flex-grow-1 d-flex flex-column justify-content-center">
        <div class="d-flex flex-row justify-content-evenly align-items-center">
            <div>
                <form method="post" action="identification.php">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h1 class="fw-bold mb-5">Connexion</h1>
                        <div class="input-group mb-4 mt-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" name="username" value="<?=$user?>" placeholder="" oninput="checkInput();" required>
                                <label for="username" class="text-uppercase fw-bold">Nom d'utilisateur</label>
                            </div>
                        </div>
                        <div class="input-group mb-3" style="<?php
                         if(isset($_POST['valider'])){
                            if (!($user == "admin" && $mdp == '$iutinfo')){
                                echo 'border: 1px solid red;
                                border-radius: 5px;';
                            }
                        }?>">
                            <div class="form-floating">
                                <input type="password" name="mdp" value="" class="form-control" placeholder="" id="password" oninput="checkInput();" required>
                                <label for="password" class="text-uppercase fw-bold">Mot de passe</label>
                            </div>
                            <span class="input-group-text" onClick="passwordShowHide();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none" id="hideEye">
                                    <path d="M24.4246 0.457308L20.0416 4.84032C18.066 3.65206 15.8054 3.02105 13.5 3.01432C7.46774 3.01432 2.28931 7.32992 0.0184071 13.5C0.957633 16.1092 2.50596 18.4566 4.53474 20.3471L0.457308 24.4246C0.314238 24.5628 0.200121 24.7281 0.121614 24.9108C0.0431079 25.0936 0.00178492 25.2901 5.65579e-05 25.489C-0.00167181 25.6879 0.036229 25.8852 0.111548 26.0693C0.186866 26.2534 0.298094 26.4206 0.438741 26.5613C0.579388 26.7019 0.746637 26.8131 0.93073 26.8885C1.11482 26.9638 1.31207 27.0017 1.51097 26.9999C1.70987 26.9982 1.90643 26.9569 2.08919 26.8784C2.27194 26.7999 2.43723 26.6858 2.57542 26.5427L26.5427 2.57542C26.6858 2.43723 26.7999 2.27194 26.8784 2.08919C26.9569 1.90643 26.9982 1.70987 26.9999 1.51097C27.0017 1.31207 26.9638 1.11482 26.8885 0.93073C26.8131 0.746637 26.7019 0.579388 26.5613 0.438741C26.4206 0.298094 26.2534 0.186866 26.0693 0.111548C25.8852 0.036229 25.6879 -0.00167181 25.489 5.65579e-05C25.2901 0.00178492 25.0936 0.0431079 24.9108 0.121614C24.7281 0.200121 24.5628 0.314238 24.4246 0.457308ZM9.45552 15.4219C9.16196 14.8236 9.00829 14.1664 9.00614 13.5C9.00614 12.3082 9.47959 11.1651 10.3224 10.3224C11.1651 9.47959 12.3082 9.00614 13.5 9.00614C14.1664 9.00829 14.8236 9.16196 15.4219 9.45552L9.45552 15.4219ZM25.196 9.9139C25.9196 11.0409 26.5183 12.2434 26.9816 13.5C24.7107 19.6701 19.5323 23.9857 13.5 23.9857C12.7682 23.9851 12.0379 23.9205 11.3175 23.7924L25.196 9.9139Z" fill="#657280"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none" id="showEye" class="d-none">
                                    <path d="M13.4998 2.8125C8.78529 2.8125 5.40703 5.44868 3.26562 7.95206C1.96967 9.46706 0.883096 11.1767 0.0875952 13.007C-0.0254491 13.2671 -0.0292692 13.5616 0.0772454 13.8246C0.830478 15.6833 1.88947 17.4241 3.1699 18.9649C5.28898 21.5148 8.67014 24.1875 13.4998 24.1875C18.3295 24.1875 21.7106 21.5148 23.8297 18.9649C25.1101 17.4241 26.1691 15.6833 26.9224 13.8246C27.0289 13.5616 27.025 13.2671 26.9121 13.0069C26.113 11.1646 25.0443 9.48387 23.734 7.95206C21.5926 5.44868 18.2143 2.8125 13.4998 2.8125ZM17.4375 13.5C17.4375 15.6746 15.6746 17.4375 13.5 17.4375C11.3254 17.4375 9.5625 15.6746 9.5625 13.5C9.5625 11.3254 11.3254 9.5625 13.5 9.5625C15.6746 9.5625 17.4375 11.3254 17.4375 13.5Z" fill="#657280"/>
                                </svg>
                            </span>
                         </div>
                         <?php
                         if(isset($_POST['valider'])){
                            if (!($user == "admin" && $mdp == '$iutinfo')){
                                echo 
                                '<div class="d-flex flex-row align-items-center justify-content-center" style="height:100px; width:100%; border-radius: 15px; border: 1px solid #D25050;background: #D25050; margin-top:5%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <path d="M23.743 4.58111C21.8481 2.68616 19.4338 1.39569 16.8054 0.872877C14.177 0.350063 11.4527 0.61839 8.97681 1.64393C6.50095 2.66946 4.38479 4.40615 2.89595 6.63436C1.4071 8.86258 0.612429 11.4823 0.612429 14.1621C0.612429 16.842 1.4071 19.4616 2.89595 21.6899C4.38479 23.9181 6.50095 25.6548 8.97681 26.6803C11.4527 27.7058 14.177 27.9742 16.8054 27.4513C19.4338 26.9285 21.8481 25.6381 23.743 23.7431C25.0086 22.4891 26.0132 20.9967 26.6988 19.3522C27.3843 17.7078 27.7373 15.9438 27.7373 14.1621C27.7373 12.3805 27.3843 10.6164 26.6988 8.97197C26.0132 7.3275 25.0086 5.83515 23.743 4.58111ZM17.646 19.3881L14.162 15.9041L10.678 19.3881C10.447 19.6191 10.1337 19.7489 9.80701 19.7489C9.48032 19.7489 9.16701 19.6191 8.93601 19.3881C8.70501 19.1571 8.57523 18.8438 8.57523 18.5171C8.57523 18.1904 8.70501 17.8771 8.93601 17.6461L12.42 14.1621L8.93601 10.6781C8.70501 10.4471 8.57523 10.1338 8.57523 9.80711C8.57523 9.48042 8.70501 9.16711 8.93601 8.93611C9.16702 8.7051 9.48032 8.57533 9.80701 8.57533C10.1337 8.57533 10.447 8.7051 10.678 8.93611L14.162 12.4201L17.646 8.93611C17.877 8.7051 18.1903 8.57533 18.517 8.57533C18.8437 8.57533 19.157 8.7051 19.388 8.93611C19.619 9.16711 19.7488 9.48042 19.7488 9.80711C19.7488 10.1338 19.619 10.4471 19.388 10.6781L15.904 14.1621L19.388 17.6461C19.619 17.8771 19.7488 18.1904 19.7488 18.5171C19.7488 18.8438 19.619 19.1571 19.388 19.3881C19.157 19.6191 18.8437 19.7489 18.517 19.7489C18.1903 19.7489 17.877 19.6191 17.646 19.3881Z" fill="white"/>
                                    </svg>
                                    <h6 style="color:#FFF;; margin-left: 10%;">Nom de compte ou mot de passe incorect</h5>
                                </div>';
                            }
                         }
                        ?>
                        <button type="submit" name="valider" value="Login" class="btn btn-bd-primary p-4 mt-5" style="border-radius: 30px; width: 100px;" id="connexion" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="44" viewBox="0 0 52 44" fill="none" id="arrowEnabled" class="d-none">
                                <path d="M2 22H50M50 22L30 2M50 22L30 42" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="44" viewBox="0 0 52 44" fill="none" id="arrowDisabled">
                                <path d="M2 22H50M50 22L30 2M50 22L30 42" stroke="#657280" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
                
            </div>
            <div>
                <img src="../img/cabinet.png" alt="logo" style="user-select: none; margin: 5%;">
            </div>
        </div>
    </main>

    <footer>
        <div class="d-flex flex-column justify-content-center align-items-center my-5">
            <h6>Application Web réalisée par</h6>
            <h6>BERNARD-NICOD Vivien</h6>
            <h6>KOH You Chen</h6>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function passwordShowHide() {
            let password = document.getElementById("password");
            let showEye = document.getElementById("showEye");
            let hideEye = document.getElementById("hideEye");
            showEye.classList.remove("d-none");
            if (password.type === "password") {
                password.type = "text";
                showEye.style.display = "block";
                hideEye.style.display = "none";
            } else {
                password.type = "password";
                showEye.style.display = "none";
                hideEye.style.display = "block";
            }
        }

        function checkInput() {
            let username = document.getElementById('username');
            let password = document.getElementById('password');
            let submitButton = document.getElementById('connexion');
            let arrowEnabled = document.getElementById('arrowEnabled');
            let arrowDisabled = document.getElementById('arrowDisabled');
            arrowEnabled.classList.remove("d-none");
            if (username.value.trim() !== '' && password.value.trim() !== '') {
                arrowEnabled.style.display = "block";
                arrowDisabled.style.display = "none";
                submitButton.disabled = false;
            } else {
                arrowEnabled.style.display = "none";
                arrowDisabled.style.display = "block";
                submitButton.disabled = true;
            }
        }
    </script>
</body>
</html>