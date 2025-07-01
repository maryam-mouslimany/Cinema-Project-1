<?php
require_once("Model.php");

class UserGenre extends Model
{
    private int $id;
    private int $user_id;
    private int $genre_id;

    protected static string $table = "user_genres";

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->user_id = $data['user_id'];
        $this->genre_id = $data['genre_id'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getGenreId(): int
    {
        return $this->genre_id;
    }

    public function toArray(): array
    {
        return [
            'id'       => $this->id,
            'user_id'  => $this->user_id,
            'genre_id' => $this->genre_id,
        ];
    }
}
