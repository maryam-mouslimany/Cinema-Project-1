<?php
require_once("Model.php");

class User extends Model
{

    protected int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private string $phone;
    private int $role_id;
    private string $birth_date;
    private ?string $communication_preference;
    private ?string $payment_method;


    protected static string $table = "users";

    public function __construct(array $data)
    {
        $this->id         = $data['id'];
        $this->first_name = $data['first_name'];
        $this->last_name  = $data['last_name'];
        $this->email      = $data['email'];
        $this->password   = $data['password'];
        $this->phone      = $data['phone'];
        $this->role_id    = $data['role_id'];
        $this->birth_date = $data['birth_date'];
        $this->payment_method = $data['payment_method'] ?? '';
        $this->communication_preference = $data['communication_preference'] ?? '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setFirstName(string $name): void
    {
        $this->first_name = $name;
    }

    public function setLastName(string $name): void
    {
        $this->last_name = $name;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'role_id'     => $this->role_id,
            'birth_date'  => $this->birth_date,
            'payment_method'  => $this->payment_method,
            'communication_preference'  => $this->communication_preference
        ];
    }

    public static function findByEmail(mysqli $mysqli, string $email)
    {

        $sql = "SELECT * FROM users WHERE email = ?";

        $query = $mysqli->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public function verifyPassword(string $input)
    {
        return password_verify($input, $this->password);
    }

    public function getGenres(mysqli $mysqli)
    {
        $sql = $mysqli->prepare("
            SELECT genres.*
            FROM genres
            JOIN user_genres
                ON user_genres.genre_id = genres.id
            WHERE user_genres.user_id = ? ");
        $sql->bind_param("i", $this->id);
        $sql->execute();
        $genres = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $genres;
    }
}
