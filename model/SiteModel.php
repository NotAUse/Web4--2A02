<?php

class Site {
    private ?int $id_site;
    private ?string $nom;
    private ?string $localisation;
    private ?string $descriptions;

    public function __construct(?int $id_site, ?string $nom, ?string $localisation, ?string $descriptions)  {
        $this->id_site = $id_site;
        $this->nom = $nom ;
        $this->localisation = $localisation;
        $this->descriptions = $descriptions;
        
    }


    public function getId(): ?int {
        return $this->id_site;
    }

    public function setId(?int $id_site): void {
        $this->id_site = $id_site;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getLocalisation(): ?string {
        return $this->localisation;
    }

    public function setlocalisation(?string $localisation): void {
        $this->localisation = $localisation;
    }

    public function getDescription(): string {
        return $this->descriptions;
    }

    public function setDescription(string $descriptions): void {
        $this->descriptions = $descriptions;
    }
}

?>
