<?php
    // Connexion au serveur MySQL
    try {
        $linkpdo = new PDO("mysql:host=mysql-ycvcabinetapi.alwaysdata.net;dbname=ycvcabinetapi_db;port=3306", '350734', 'V6nk2TjnBGxM679');       
    }
    // Capture des erreurs éventuelles
        catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
 ?>