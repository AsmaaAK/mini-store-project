<?php
// src/Modules/Users/User.php
namespace MiniStore\Modules\Users;

abstract class User
{
    protected string $id;
    protected string $name;
    protected string $email;
    protected string $password;

    public function __construct(string $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }

    // Abstract method
    abstract public function getRole(): string;
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}