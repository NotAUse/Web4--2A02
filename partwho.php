<?php

class Partic {
    private ?int $id_part;
    private ?int $id_user;
    private ?int $id_event;
    private ?string $date_part;
    private ?int $nbr_ticket;
    private ?string $payed;

    // Constructor
    public function __construct(?int $id_part, ?int $id_user, ?int $id_event, ?string $date_part, ?int $nbr_ticket, ?string $payed) {
        $this->id_part = $id_part;
        $this->id_user = $id_user;
        $this->id_event = $id_event;
        $this->date_part = $date_part;
        $this->nbr_ticket = $nbr_ticket;
        $this->payed = $payed;
    }

    // Getters and Setters

    public function getIdPart(): ?int {
        return $this->id_part;
    }

    public function setIdPart(?int $id_part): void {
        $this->id_part = $id_part;
    }

    public function getIdUser(): ?int {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): void {
        $this->id_user = $id_user;
    }

    public function getIdEvent(): ?int {
        return $this->id_event;
    }

    public function setIdEvent(?int $id_event): void {
        $this->id_event = $id_event;
    }

    public function getDate(): ?string {
        return $this->date_part;
    }

    public function setDate(?string $date_part): void {
        $this->date_part = $date_part;
    }

    public function getNbr(): ?int {
        return $this->nbr_ticket;
    }

    public function setLocalisation(?int $nbr_ticket): void {
        $this->nbr_ticket = $nbr_ticket;
    }


    public function getPayed(): string {
        return $this->payed;
    }

    public function setPayed(string $payed): void {
        $this->payed = $payed;
    }
}

?>