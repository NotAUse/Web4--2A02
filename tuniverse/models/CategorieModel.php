<?php

class CategorieModel {
    private ?int $id;
    private ?string $nom;
    private ?string $description;
    private ?string $langue;
    private ?int $popularite;
    private ?DateTime $date_ajout;

    // Constructor
    public function __construct(?int $id, ?string $nom, ?string $description , ?string $langue, ?int $popularite, ?DateTime $date_ajout) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->langue = $langue;
        $this->popularite = $popularite;
        $this->date_ajout = $date_ajout;
       
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description ): void {
        $this->description = $description;
    }

    public function getLangue(): ?string {
        return $this->langue;
    }

    public function setLangue(?string $langue): void {
        $this->langue = $langue;
    }

    public function getPopularite(): ?int {
        return $this->popularite;
    }

    public function setPopularite(?int $popularite): void {
        $this->popularite = $popularite;
    }

    public function getDate_ajout(): ?DateTime {
        return $this->date_ajout;
    }

    public function setDate_ajout(?DateTime $date_ajout): void {
        $this->date_ajout = $date_ajout;
    }

    
   
}

?>