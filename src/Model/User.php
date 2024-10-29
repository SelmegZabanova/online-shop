<?php
namespace Model;

class User extends Model
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public static function create(string $name, string $email, string $password): void
    {

        $stmt = self::getPDO()->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }
    public static function getByEmail(string $email): ?User
    {
        $stmt = self::getPDO()->prepare('SELECT * FROM users WHERE email = :email');

        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch();
        if($data === false){
            return null;
        }
        $obj= new self();
        $obj->id = $data['id'];
        $obj->name = $data['name'];
        $obj->email = $data['email'];
        $obj->password = $data['password'];
        return $obj;

    }
    public static function getById(int $user_id): ?User
    {
        $stmt = self::getPDO()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $user_id]);
        $data = $stmt->fetch();
        if($data === false){
            return null;
        }
        $obj= new self();
        $obj->id = $data['id'];
        $obj->name = $data['name'];
        $obj->email = $data['email'];
        $obj->password = $data['password'];
        return $obj;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}


