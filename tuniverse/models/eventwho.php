<?php

class EventsW {
    private ?int $id;
    private ?string $img;
    private ?string $Nom;
    private ?string $description;
    private ?string $localisation;
    private ?float $price;
    private ?string $category;
    private ?string $contact_info;

    // Constructor
    public function __construct(?int $id, ?string $Nom, ?string $img, ?string $description, ?string $localisation, ?float $price, ?string $category, ?string $contact_info) {
        $this->id = $id;
        $this->img = $img;
        $this->Nom = $Nom;
        $this->description = $description;
        $this->localisation = $localisation;
        $this->price = $price;
        $this->contact_info = $contact_info;
        $this->category = $category;
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getImg(): ?string {
        return $this->img;
    }
    public function setImg(?string $img): void {
        $this->img = $img;
    }
    public function getNom(): ?string {
        return $this->Nom;
    }

    public function setNom(?string $Nom): void {
        $this->Nom = $Nom;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getLocalisation(): ?string {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): void {
        $this->localisation = $localisation;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }
    public function getContact_info(): string {
        return $this->contact_info;
    }
    public function setContact_info(string $contact_info): void {
        $this->contact_info = $contact_info;
    }
}

?>