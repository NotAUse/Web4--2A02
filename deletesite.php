<?php
include '../../controller/siteController.php';
$siteC = new siteController();
$siteC->deletesite($_GET["id_site"]);
header('Location:siteList.php');
