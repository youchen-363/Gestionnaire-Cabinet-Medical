<?php
    function calculerAge($usgs){
        $nbHommeSup50 = $nbHommeMilieu = $nbHommeInf25 = $nbFemmeInf25 = $nbFemmeMilieu = $nbFemmeSup50 = $nbAutreSup50 = $nbAutreMilieu = $nbAutreInf25 = 0;
        foreach ($usgs as $usg){
            $age = ageUsager($usg['dateNaissance']);
            if ($age<25) {
                if ($usg['civilite'] == "M"){
                    $nbHommeInf25++;
                } else if ($usg['civilite'] == "Mme"){
                    $nbFemmeInf25++;
                } else {
                    $nbAutreInf25++;
                }
            } elseif ($age <=50){
                if ($usg['civilite'] == "M"){
                    $nbHommeMilieu++;
                } else if ($usg['civilite'] == "Mme"){
                    $nbFemmeMilieu++;
                } else {
                    $nbAutreMilieu++;
                }
            } else {
                if ($usg['civilite'] == "M"){
                    $nbHommeSup50++;
                } else if ($usg['civilite'] == "Mme"){
                    $nbFemmeSup50++;
                } else {
                    $nbAutreSup50++;
                }
            }
        }
        return array(
            'inf' => array('homme' => $nbHommeInf25, 'femme' => $nbFemmeInf25, 'autre' => $nbAutreInf25),
            'mid' => array('homme' => $nbHommeMilieu, 'femme' => $nbFemmeMilieu, 'autre' => $nbAutreMilieu),
            'sup' => array('homme' => $nbHommeSup50, 'femme' => $nbFemmeSup50, 'autre' => $nbAutreSup50)
        );
    }

    function calculerDureeMeds($cons){
        $array = array();
        foreach ($cons as $con){
            $nom = getNomMedecinById($con['idMedecin']);
            if (!array_key_exists($nom, $array)){
                $array[$nom] = 0;
            }
            $array[$nom] += $con['Duree'];
        }
        return $array;
    }

    function heureToHeureMinute($duree){
        $heure = intval($duree / 60);
        $minutes = $duree % 60;
        if($minutes < 10){
            $minutes = $minutes.'0';
        }
        return $heure.'h'.$minutes;
    }
?>