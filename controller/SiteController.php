<?php
include_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/SiteModel.php');

class SiteController
{
    public function listsite()
    {
        $sql = "SELECT * FROM sites";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletesite($id_site)
    {
        $sql = "DELETE FROM sites WHERE id_site = :id_site";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_site', $id_site);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addsite($site)
    {
        var_dump($site);
        $sql = "INSERT INTO sites  
        VALUES (NULL, :nom, :localisation, :descriptions, :latitude, :longitude , :images)";
        $db = config::getConnexion();
        try {

            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $site->getNom(),
                'localisation' => $site->getLocalisation(),
                'descriptions' => $site->getDescription(),
                'latitude' => $site->getLatitude(),
                'longitude' => $site->getLongitude(),
                'images' => $site->getImages()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatesite($site, $id_site)
    {
        var_dump($site);
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE sites SET 
                nom = :nom,
                localisation = :localisation,
                descriptions = :descriptions,
                latitude = :latitude,
                longitude = :longitude   
            WHERE id_site = :id_site'
            );

            $query->execute([
                'id_site' => $id_site,
                'nom' => $site->getNom(),
                'localisation' => $site->getLocalisation(),
                'descriptions' => $site->getDescription(),
                'latitude' => $site->getLatitude(),
                'longitude' => $site->getLongitude()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function showsite($id_site)
    {
        $sql = "SELECT * from sites where id_site = $id_site";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $site = $query->fetch();
            return $site;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function searchSites($id_site=null, $nom = null, $localisation = null, $descriptions = null)
{
    $sql = "SELECT * FROM sites WHERE 1=1";
    $params = [];

    if ($id_site) {
        $sql .= " AND id_site = :id_site";
        $params['id_site'] = $id_site;
    }

    if ($nom) {
        $sql .= " AND nom LIKE :nom";
        $params['nom'] = '%' . $nom . '%';
    }

    if ($localisation) {
        $sql .= " AND localisation LIKE :localisation";
        $params['localisation'] = '%' . $localisation . '%';
    }

    if ($descriptions) {
        $sql .= " AND descriptions LIKE :descriptions";
        $params['descriptions'] = '%' . $descriptions . '%';
    }

    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
    
}
