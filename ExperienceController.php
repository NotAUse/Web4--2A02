<?php
include_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/ExperienceModel.php');

class ExperienceController
{

    public function listexperience()
    {
        $sql = "SELECT e.*, s.nom AS nom_site FROM experience e
JOIN sites s ON e.id_site = s.id_site";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addexperience($experience)
    {
        var_dump($experience);
        $sql = "INSERT INTO experience  
        VALUES (NULL, :titre, :descriptionE, :dateE, :noteE, :id_site)";
        $db = config::getConnexion();
        try {

            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $experience->getTitre(),
                'descriptionE' => $experience->getDescriptionE(),
                'dateE' => $experience->getDateE()->format('Y-m-d H:i:s'),
                'noteE' => $experience->getNoteE(),
                'id_site' => $experience->getSite()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function deleteexperience($id_exp)
    {
        $sql = "DELETE FROM experience WHERE id_exp = :id_exp";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_exp', $id_exp);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function showexperience($id_exp)
    {
        $sql = "SELECT * from experience where id_exp = $id_exp";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $experience = $query->fetch();
            return $experience;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function showExperienceBySite($id_site) {
        $sql = "SELECT * FROM experience WHERE id_site = :id_site ORDER BY dateE DESC";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_site' => $id_site]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function searchExperience($id_exp=null, $titre = null)
{
    $sql = "SELECT * FROM experience WHERE 1=1";
    $params = [];

    if ($id_exp) {
        $sql .= " AND id_exp = :id_exp";
        $params['id_exp'] = $id_exp;
    }

    if ($titre) {
        $sql .= " AND titre LIKE :titre";
        $params['titre'] = '%' . $titre . '%';
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
