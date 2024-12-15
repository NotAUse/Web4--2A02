<?php

class TravelOffer {
    private ?int $id;
    private ?string $title;
    private ?string $destination;
    private ?DateTime $departure_date;
    private ?DateTime $return_date;
    private ?float $price;
    private ?bool $disponible;
    private ?string $category;

    // Constructor
    public function __construct(?int $id, ?string $title, ?string $destination, ?DateTime $departure_date, ?DateTime $return_date, ?float $price, ?bool $disponible, ?string $category) {
        $this->id = $id;
        $this->title = $title;
        $this->destination = $destination;
        $this->departure_date = $departure_date;
        $this->return_date = $return_date;
        $this->price = $price;
        $this->disponible = $disponible;
        $this->category = $category;
    }

    // Getters and Setters

    

    public function getusername(): ?string {
        return $this->username;
    }

    public function getemail(): ?string {
        return $this->email;
    }

    public function getpassword(): ?string {
        return $this->password;
    }

    public function getrole(): ?string {
        return $this->role;
    }
    
}

?>