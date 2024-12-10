<?php
include '../../controller/ExperienceController.php';
$expC = new ExperienceController();
$expC->deleteexperience($_GET["id_exp"]);
header('Location:experienceList.php');
?>