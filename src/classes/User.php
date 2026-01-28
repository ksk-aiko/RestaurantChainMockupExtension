<?php
require_once 'FileConvertible.php';
require_once __DIR__ . '/../../Helpers/RandomGenerator.php';

class User implements FileConvertible {
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $hashedPassword;
    public string $phoneNumber;
    public string $address;
    public DateTime $birthDate;
    public DateTime $membershipExpirationDate;
    public string $role;

    // create a new user with random data
    public function __construct() {
        // $data is associative array with user properties
        $data = RandomGenerator::user();
        $this->id = $data['id'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->email = $data['email'];
        $this->hashedPassword = password_hash("password", PASSWORD_DEFAULT);
        $this->phoneNumber = $data['phoneNumber'];
        $this->address = $data['address'];
        $this->birthDate = $data['birthDate'];
        $this->membershipExpirationDate = $data['membershipExpirationDate'];
        $this->role = $data['role'];
    }

    public function login(string $password): bool {
        return password_verify($password, $this->hashedPassword);
    }

    public function updateProfile(string $address, string $phoneNumber): void {
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate): void {
        $this->membershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword): void {
        $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired(): bool {
        return new DateTime() > $this->membershipExpirationDate;
    }

    public function toString(): string {
        return "{$this->firstName} {$this->lastName}";
    }

    public function toHTML(): string {
        return "<p>User: {$this->toString()}</p>";
    }

    public function toMarkdown(): string {
        return "- User: {$this->toString()}";
    }

    public function toArray(): array {
        return get_object_vars($this);
    }
}
