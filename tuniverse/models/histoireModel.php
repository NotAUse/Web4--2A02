<?php

class CategorieModel {
    private ?int $id;
    private ?string $titre;
    private ?string $contenu;
    private ?DateTime $date_creation;
    private ?int $categorie_id;

    // Constructor
    public function __construct(?int $id, ?string $titre, ?string $contenu , ?DateTime $date_creation , ?int $categorie_id) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->date_creation = $date_creation;
        $this->categorie_id = $categorie_id;
       
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getTitre(): ?string {
        return $this->titre;
    }

    public function setTitre(?string $titre): void {
        $this->nom = $titre;
    }

    public function getContenu(): ?string {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): void {
        $this->contenu = $contenu;
    }

    public function getDate_creation(): ?DateTime {
        return $this->date_creation;
    }

    public function setDate_creation(?DateTime $date_creation): void {
        $this->date_creation = $date_creation;
    }

    public function getCategorie_id(): ?int {
        return $this->categorie_id;
    }

    public function setCategorie_id(?int $categorie_id): void {
        $this->categorie_id = $categorie_id;
    }

    
   
}

?>
