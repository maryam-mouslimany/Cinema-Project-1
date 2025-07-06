<?php
require_once("Model.php");

class Movie extends Model {

    protected int $id;
    private string $name;
    private string $description;
    private string $cast;
    private string $duration;
    private ?string $image; 

    protected static string $table = "movies";

    public function __construct(array $data) {
        $this->id          = $data['id'];
        $this->name        = $data['name'];
        $this->description = $data['description'];
        $this->cast        = $data['cast'];
        $this->duration    = $data['duration'];
        $this->image       = $data['image'] ?? null;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCast(): string {
        return $this->cast;
    }

    public function getDuration(): string {
        return $this->duration;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setCast(string $cast): void {
        $this->cast = $cast;
    }

    public function setDuration(string $duration): void {
        $this->duration = $duration;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function toArray(): array {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'cast'        => $this->cast,
            'duration'    => $this->duration,
            'image'       => $this->image
        ];
    }
}
