<?php
namespace MiniStore\Modules\Users;

class Customer extends User
{
    private string $address;
    private string $phone;

    public function __construct(string $id, string $name, string $email, string $password, string $address, string $phone)
    {
        parent::__construct($id, $name, $email, $password);
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getRole(): string
    {
        return 'customer';
    }

    // Getters
    public function getAddress(): string { return $this->address; }
    public function getPhone(): string { return $this->phone; }
}