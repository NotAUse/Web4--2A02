<?php

class Site {
    private ?int $id_site;
    private ?string $nom;
    private ?string $localisation;
    private ?string $descriptions;
    private ?string $latitude;
    private ?string $longitude;
    private ?string $images;
    

    public function __construct(?int $id_site, ?string $nom, ?string $localisation, ?string $descriptions, ?string $latitude, ?string $longitude, ?string $images)  {
        $this->id_site = $id_site;
        $this->nom = $nom ;
        $this->localisation = $localisation;
        $this->descriptions = $descriptions;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->images = $images;
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

    public function getLatitude():?string {
        return $this->latitude;
    }
    
    public function setLatitude(?string $latitude): void {
        $this->latitude = $latitude;
    }
    
    public function getLongitude():?string {
        return $this->longitude;
    }
    
    public function setLongitude(?string $longitude): void {
        $this->longitude = $longitude;
    }
    
    public function getImages():?string {
        return $this->images;
    }
    
    public function setImages(?string $images): void {
        $this->images = $images;
    }
}

?>
