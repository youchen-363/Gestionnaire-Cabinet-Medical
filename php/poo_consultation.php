<?php
    class Consultation {
        // Propriétés (variables de la classe)
        private $nomMed;
        private $prenomMed;
        private $idMed;
        private $nomU;
        private $prenomU;
        private $idU;
        private $dateTime;
        private $duree;

        // Constructeur
        public function __construct($nomMed, $prenomMed, $idMed, $nomU, $prenomU, $idU, $dateTime, $duree) {
            $this->nomMed = $nomMed;
            $this->prenomMed = $prenomMed;
            $this->idMed = $idMed;
            $this->nomU = $nomU;
            $this->prenomU = $prenomU;
            $this->idU = $idU;
            $this->dateTime = $dateTime;
            $this->duree = $duree;
        }

        private function formatDuree(){
            $heure = intval($this->duree / 60);
            $minutes = $this->duree % 60;
            if($minutes < 10){
                $minutes = $minutes.'0';
            }
            return $heure.'h'.$minutes;
        }

        private function formatDate(){
            $dateTime = new DateTime($this->dateTime);
            return $dateTime->format('d/m/Y');
        }

        private function formatDateModif(){
            $dateTime = new DateTime($this->dateTime);
            return $dateTime->format('d/m/Y');
        }

        private function formatHeure(){
            $dateTime = new DateTime($this->dateTime);
            $heure = $dateTime->format('H');
            $minute = $dateTime->format('i');
            return $heure.'h'.$minute;
        }

        private function formatHeurePoints(){
            $dateTime = new DateTime($this->dateTime);
            return $dateTime->format('H:i');
        }


        // Méthode publique
        public function afficherInfos() {
            echo '
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex flex-row justify-content-start">
                        <div class="d-flex flex-row justify-content-between ms-3 align-items-center" style="width: 100%;">
                            <h5 class="my-3" style="width: 24%;">'.$this->nomMed.' '.$this->prenomMed.'</h5>
                            <h5 class="my-3" style="width: 22%;">'.$this->nomU.' '.$this->prenomU.'</h5>
                            <h5 class="my-3" style="width: 27%;">'.$this->formatDate().' '.$this->formatHeure().'</h5>
                            <h5 class="my-3" style="width: 11.5%;">'.$this->formatDuree().'</h5>
                            <div>
                                <a href="consultation_suppression.php?idUsager='.$this->idU.'&date='.$this->formatDateModif().'&hour='.$this->formatHeurePoints().'&duree='.$this->duree.'&idMedecin='.$this->idMed.'" style="margin-right: 10px;"> 
                                    <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 26" fill="none">
                                        <path d="M22 6.52942H2" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M19 2H5" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M20.0386 9.47058L19.4974 17.5871C19.2892 20.7105 19.1851 22.2723 18.1674 23.2243C17.1498 24.1764 15.5846 24.1764 12.4543 24.1764H11.5445C8.41412 24.1764 6.84895 24.1764 5.8313 23.2243C4.81366 22.2723 4.70954 20.7105 4.50131 17.5871L3.96021 9.47058" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="consultation_modification.php?idUsager='.$this->idU.'&date='.$this->formatDateModif().'&hour='.$this->formatHeurePoints().'&duree='.$this->duree.'&idMedecin='.$this->idMed.'" style="margin-right: 10px;"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none" style="vertical-align: sub;">
                                        <path d="M2 21.4825H22M2 21.4825V16.4825L15.5857 2.89674L15.588 2.89462C16.0815 2.40102 16.3287 2.15378 16.6137 2.06118C16.8649 1.97961 17.1352 1.97961 17.3864 2.06118C17.6711 2.15372 17.9181 2.40067 18.411 2.89357L20.5858 5.06832C21.0808 5.56334 21.3284 5.81097 21.4211 6.09638C21.5027 6.34743 21.5026 6.61786 21.4211 6.86892C21.3285 7.15412 21.0812 7.40137 20.5869 7.89568L20.5858 7.89674L7 21.4825H2Z" stroke="#3EB1A8" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </h2>
                </div>
            ';
        }
    }
?>