<?php

class experience{
    private ?int $id_exp;
    private ?string $titre;
    private ?string $descriptionE;
    private ?DateTime $dateE;
    private?int $noteE;
    private ?int $id_site;
    private ?string $nom_site;
    private ?int $views;
    
    public function __construct(?int $id_exp,?string $titre,?string $descriptionE,?DateTime $dateE,?int $noteE,?int $id_site,?string $nom_site,?int $views) {
        $this->id_exp = $id_exp;
        $this->titre = $titre;
        $this->descriptionE = $descriptionE;
        $this->dateE = $dateE;
        $this->noteE = $noteE;
        $this->id_site = $id_site;
        $this->nom_site = $nom_site;
        $this->views = $views;
    }
    
    public function getIdExp():?int {
        return $this->id_exp;
    }
    
    public function setIdExp(?int $id_exp): void {
        $this->id_exp = $id_exp;
    }
    
    public function getTitre():?string {
        return $this->titre;
    }
    
    public function setTitre(?string $titre): void {
        $this->titre = $titre;
    }

    public function getDescriptionE():?string {
        return $this->descriptionE;
    }
    
    public function setDescriptionE(?string $descriptionE): void {
        $this->descriptionE = $descriptionE;
    }
    
    public function getDateE():?DateTime {
        return $this->dateE;
    }
    
    public function setDateE(?DateTime $dateE): void {
        $this->dateE = $dateE;
    }
    
    public function getNoteE():?int {
        return $this->noteE;
    }
    
    public function setNoteE(?int $noteE): void {
        $this->noteE = $noteE;
    }
    
    public function getSite():?int {
        return $this->id_site;
    }
    
    public function setSite(?int $id_site): void {
        $this->id_site = $id_site;
    }
    
    public function getNomSite():?string {
        return $this->nom_site;
    }
    
    public function setNomSite(?string $nom_site): void {
        $this->nom_site = $nom_site;
    }
    
    public function getViews():?int {
        return $this->views;
    }
    
    public function setViews(?int $views): void {
        $this->views = $views;
    }

}
?>