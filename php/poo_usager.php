<?php
    class Usager {
        // Propriétés (variables de la classe)
        private $nom;
        private $prenom;
        private $numeroSecu;
        private $adresse;
        private $ville;
        private $cp;
        private $dateNaissance;
        private $villeNaissance;
        private $cpNaissance;
        private $medecin;
        private $id;
        private $civilite;

        // Constructeur
        public function __construct($id, $nom, $prenom, $civilite, $numeroSecu, $adresse, $ville, $cp, $dateNaissance, $cpNaissance, $medecin, $villeNaissance) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->numeroSecu = $numeroSecu;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->cp = $cp;
            $this->dateNaissance = $dateNaissance;
            $this->villeNaissance = $villeNaissance;
            $this->cpNaissance = $cpNaissance;
            $this->medecin = $medecin;
            $this->civilite = $civilite;
        }

        private function formatDate(){
            return date("d/m/Y", strtotime($this->dateNaissance));
        }

        private function formatSecu(){
            if(strlen($this->numeroSecu) == 13){
                $tableau = str_split($this->numeroSecu);
                return $tableau[0].'.'.$tableau[1].$tableau[2].'.'.$tableau[3].$tableau[4].'.'.$tableau[5].$tableau[6].'.'.$tableau[7].$tableau[8].$tableau[9].'.'.$tableau[10].$tableau[11].$tableau[12];
            }
        }

        private function formatCivilite(){
            $civiliteFormat;
            if ($this->civilite == 'M') {
                $civiliteFormat = 'Monsieur';
            } elseif ($this->civilite == 'Mme') {
                $civiliteFormat = 'Madame';
            } else {
                $civiliteFormat = 'Autre';
            }
            return $civiliteFormat;
        }

        private function formatNom(){
            return strtoupper($this->nom);
        }

        // Méthode publique
        public function afficherInfos() {
            echo '<div class="accordion-item">
            <h2 class="accordion-header d-flex flex-row justify-content-start">
                <div class="d-flex flex-row justify-content-between ms-3 align-items-center" style="width: 100%;">
                    <h5 class="my-3" style="width: 30%;">'.$this->formatNom().'</h5>
                    <h5 class="my-3" style="width: 32%;">'.$this->prenom.'</h5>
                    <h5 class="my-3" style="width: 27%;">'.$this->formatMedecin().'</h5>
                    <div>
                        <a href="usager_suppression.php?idU='.$this->id.'&cv='.$this->civilite.'&numSecu='.$this->numeroSecu.'&nom='.$this->nom.'&pnom='.$this->prenom.'&adr='.$this->adresse.'&cp='.$this->cp.'&ville='.$this->ville.'&dateN='.$this->dateNaissance.'&villeN='.$this->villeNaissance.'&cpN='.$this->cpNaissance.'&med='.$this->medecin.'"> 
                            <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 26" fill="none">
                                <path d="M22 6.52942H2" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round"/>
                                <path d="M19 2H5" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round"/>
                                <path d="M20.0386 9.47058L19.4974 17.5871C19.2892 20.7105 19.1851 22.2723 18.1674 23.2243C17.1498 24.1764 15.5846 24.1764 12.4543 24.1764H11.5445C8.41412 24.1764 6.84895 24.1764 5.8313 23.2243C4.81366 22.2723 4.70954 20.7105 4.50131 17.5871L3.96021 9.47058" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="usager_modification.php?idU='.$this->id.'&cv='.$this->civilite.'&numSecu='.$this->numeroSecu.'&nom='.$this->nom.'&pnom='.$this->prenom.'&adr='.$this->adresse.'&cp='.$this->cp.'&ville='.$this->ville.'&dateN='.$this->dateNaissance.'&villeN='.$this->villeNaissance.'&cpN='.$this->cpNaissance.'&med='.$this->medecin.'"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none" style="vertical-align: sub;">
                                <path d="M2 21.4825H22M2 21.4825V16.4825L15.5857 2.89674L15.588 2.89462C16.0815 2.40102 16.3287 2.15378 16.6137 2.06118C16.8649 1.97961 17.1352 1.97961 17.3864 2.06118C17.6711 2.15372 17.9181 2.40067 18.411 2.89357L20.5858 5.06832C21.0808 5.56334 21.3284 5.81097 21.4211 6.09638C21.5027 6.34743 21.5026 6.61786 21.4211 6.86892C21.3285 7.15412 21.0812 7.40137 20.5869 7.89568L20.5858 7.89674L7 21.4825H2Z" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$this->id.'" aria-expanded="false" aria-controls="collapseTwo" style="width: 5%; margin-right: 10px;"></button>
                </button>
            </h2>
            <div id="collapse'.$this->id.'" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body d-flex flex-row" style="border-radius: 15px; background: #F5F5F5; border: 10px solid #3EB1A8;">
                    <div class="divProfileImg">
                        <img src="https://libreemploi.qc.ca/wp-content/uploads/2020/02/blank-profile-picture-973460_1280.png" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-evenly">
                        <div class="d-flex flex-row align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="45" viewBox="0 0 36 45" fill="none" class="me-5">
                                <path d="M18.0002 18C22.9707 18 27.0002 13.9706 27.0002 9C27.0002 4.02944 22.9707 0 18.0002 0C13.0296 0 9.00018 4.02944 9.00018 9C9.00018 13.9706 13.0296 18 18.0002 18Z" fill="#253342"/>
                                <path d="M36 34.875C36 40.4669 36 45 18 45C0 45 0 40.4669 0 34.875C0 29.2831 8.05887 24.75 18 24.75C27.9412 24.75 36 29.2831 36 34.875Z" fill="#253342"/>
                            </svg>
                            <h5>'.$this->formatCivilite().'</h5>
                        </div>
                        <div class="d-flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="45" viewBox="0 0 40 45" fill="none" class="me-5">
                                <path d="M23.1582 0H18.7401C14.639 0 10.7059 1.62916 7.80593 4.52908C4.90601 7.429 3.27686 11.3621 3.27686 15.4632C3.27686 16.0491 3.50959 16.611 3.92387 17.0253C4.33814 17.4395 4.90002 17.6723 5.48589 17.6723H23.1582C23.744 17.6723 24.3059 17.4395 24.7202 17.0253C25.1345 16.611 25.3672 16.0491 25.3672 15.4632V2.20903C25.3672 1.62316 25.1345 1.06129 24.7202 0.647011C24.3059 0.232737 23.744 0 23.1582 0Z" fill="#253342"/>
                                <path d="M37.5538 13.2542H2.20922C1.62335 13.2542 1.06147 13.4869 0.647194 13.9012C0.23292 14.3154 0.000183105 14.8773 0.000183105 15.4632C0.000183105 16.0491 0.23292 16.6109 0.647194 17.0252C1.06147 17.4395 1.62335 17.6722 2.20922 17.6722V19.8813C2.20922 21.596 2.60845 23.2871 3.37529 24.8208C4.14213 26.3545 5.25552 27.6886 6.62729 28.7174L4.41825 40.3369C4.31498 40.9108 4.4428 41.5023 4.77386 41.9823C5.10491 42.4623 5.61234 42.792 6.18548 42.8994C6.31712 42.9212 6.45146 42.9212 6.58311 42.8994C7.10618 42.9079 7.61531 42.7305 8.01984 42.3988C8.42437 42.0671 8.69804 41.6026 8.79214 41.088L10.7582 30.5509C11.5717 30.7778 12.4101 30.9039 13.2544 30.9264H26.5086C27.3511 30.9183 28.1894 30.807 29.0048 30.5951L30.9267 41.1322C31.0208 41.6468 31.2944 42.1113 31.699 42.443C32.1035 42.7747 32.6126 42.9521 33.1357 42.9436C33.2673 42.9654 33.4017 42.9654 33.5333 42.9436C34.1065 42.8362 34.6139 42.5065 34.9449 42.0265C35.276 41.5464 35.4038 40.955 35.3006 40.3811L33.1357 28.7174C34.5075 27.6886 35.6209 26.3545 36.3877 24.8208C37.1545 23.2871 37.5538 21.596 37.5538 19.8813V17.6722C38.1396 17.6722 38.7015 17.4395 39.1158 17.0252C39.5301 16.6109 39.7628 16.0491 39.7628 15.4632C39.7628 14.8773 39.5301 14.3154 39.1158 13.9012C38.7015 13.4869 38.1396 13.2542 37.5538 13.2542Z" fill="#253342"/>
                                <path d="M19.9493 44.1808C13.8056 44.2154 7.68225 43.4731 1.72476 41.9718C1.43467 41.8992 1.1617 41.7703 0.921439 41.5923C0.68118 41.4143 0.478337 41.1907 0.324491 40.9342C0.170646 40.6778 0.06881 40.3936 0.0247988 40.0979C-0.0192125 39.8021 -0.00453754 39.5006 0.0679861 39.2105C0.14051 38.9204 0.269462 38.6474 0.447479 38.4071C0.625496 38.1669 0.849093 37.964 1.1055 37.8102C1.36191 37.6564 1.64611 37.5545 1.94188 37.5105C2.23765 37.4665 2.53918 37.4812 2.82928 37.5537C14.0675 40.3815 25.8311 40.3815 37.0693 37.5537C37.3574 37.4541 37.663 37.4152 37.9669 37.4395C38.2708 37.4638 38.5663 37.5507 38.835 37.6948C39.1036 37.8388 39.3396 38.037 39.5279 38.2767C39.7163 38.5163 39.853 38.7924 39.9294 39.0875C40.0059 39.3826 40.0204 39.6904 39.9721 39.9913C39.9238 40.2923 39.8138 40.5801 39.6489 40.8365C39.484 41.0929 39.2678 41.3124 39.014 41.4811C38.7601 41.6499 38.4741 41.7643 38.1738 41.8171C32.223 43.3706 26.0995 44.1648 19.9493 44.1808Z" fill="#253342"/>
                            </svg>
                            <div>
                                <h5>'.$this->formatDate().'</h5>
                                <h5 class="my-3">'.$this->cpNaissance.'</h5>
                                <h5>'.$this->villeNaissance.'</h5>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="45" viewBox="0 0 32 45" fill="none" class="me-5">
                                <path d="M15.8108 0C7.06969 0 0 7.0425 0 15.75C0 27.5625 15.8108 45 15.8108 45C15.8108 45 31.6216 27.5625 31.6216 15.75C31.6216 7.0425 24.5519 0 15.8108 0ZM15.8108 21.375C12.6938 21.375 10.1641 18.855 10.1641 15.75C10.1641 12.645 12.6938 10.125 15.8108 10.125C18.9278 10.125 21.4575 12.645 21.4575 15.75C21.4575 18.855 18.9278 21.375 15.8108 21.375Z" fill="#253342"/>
                            </svg>
                            <h5>'.$this->adresse.' - '.$this->cp.' - '.$this->ville.'</h5>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none" class="me-5">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M37.5 11.8002C37.5 18.3172 32.1953 23.6004 25.6513 23.6004C24.4573 23.6004 21.7386 23.3259 20.4159 22.2283L18.7626 23.8749C17.7906 24.843 18.0531 25.128 18.4854 25.5975C18.6658 25.7934 18.876 26.0214 19.0382 26.3447C19.0382 26.3447 20.4159 28.2656 19.0382 30.1866C18.2115 31.2842 15.8968 32.8209 13.2516 30.1866L12.7005 30.7354C12.7005 30.7354 14.3538 32.6563 12.9761 34.5772C12.1494 35.6751 9.94506 36.7727 8.01621 34.8517L6.08738 36.7727C4.76473 38.0899 3.14822 37.3215 2.5053 36.7727L0.852019 35.1261C-0.691068 33.5893 0.209063 31.9245 0.852019 31.2842L15.1806 17.0143C15.1806 17.0143 13.8028 14.8188 13.8028 11.8002C13.8028 5.28313 19.1076 0 25.6513 0C32.1953 0 37.5 5.28313 37.5 11.8002ZM25.6519 15.9167C27.9345 15.9167 29.7849 14.0738 29.7849 11.8004C29.7849 9.52697 27.9345 7.68401 25.6519 7.68401C23.3691 7.68401 21.5186 9.52697 21.5186 11.8004C21.5186 14.0738 23.3691 15.9167 25.6519 15.9167Z" fill="#253342"/>
                            </svg>
                            <h5>'.$this->formatSecu().'</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }

        public function afficherInfosPourConsultation() {
            echo'
                <a href="consultation_saisie_donnees.php?idUsager='.$this->id.'">
                    <div class="accordion-item usager-consultation-row" style="border-radius: 0px;">
                        <h2 class="accordion-header d-flex flex-row justify-content-start">
                            <div class="d-flex flex-row ms-3 align-items-center" style="width: 100%;">
                                <h5 class="my-3 w-50">'.$this->formatNom().' '.$this->prenom.'</h5>
                                <h5 class="my-3 w-50">'.$this->medecin.'</h5>
                            </div>
                        </h2>
                    </div>
                </a>
            ';
        }

        // Méthode privée pour définir l'âge avec validation
        public function formatMedecin() {
            if($this->medecin == ""){
                return "Aucun";
            }
            return $this->medecin;
        }
    }
?>
