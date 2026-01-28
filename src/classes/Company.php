<?php
require_once 'FileConvertible.php';
require_once __DIR__ . '/../../Helpers/RandomGenerator.php';

class Company implements FileConvertible {
    public string $name;
    public int $foundingYear;
    public string $description;
    public string $website;
    public string $phone;
    public string $industry;
    public string $ceo;
    public bool $isPubliclyTraded;
    public string $country;
    public string $founder;
    public int $totalEmployees;

    public function __construct() {
        $data = RandomGenerator::company();
        $this->name = $data['name'];
        $this->foundingYear = $data['foundingYear'];
        $this->description = $data['description'];
        $this->website = $data['website'];
        $this->phone = $data['phone'];
        $this->industry = $data['industry'];
        $this->ceo = $data['ceo'];
        $this->isPubliclyTraded = $data['isPubliclyTraded'];
        $this->country = $data['country'];
        $this->founder = $data['founder'];
        $this->totalEmployees = $data['totalEmployees'];
    }

    public function toHTML(): string {
        return "<h1>{$this->name}</h1><p>{$this->description}</p>";
    }

    public function toString(): string { return $this->name; }
    public function toMarkdown(): string { return "# {$this->name}"; }
    public function toArray(): array { return get_object_vars($this); }
}
