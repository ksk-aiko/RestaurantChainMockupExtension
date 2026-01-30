<?php
require_once 'Employee.php';
require_once __DIR__ . '/../../Helpers/RandomGenerator.php';

class RestaurantLocation implements FileConvertible {
    public string $name;
    public string $address;
    public string $city;
    public string $state;
    public string $zipCode;
    public array $employees;
    public bool $isOpen;

    // Modify constructor to accept zip code range and employee salary range
    public function __construct(int $minZip = 10000, int $maxZip = 99999, int $minSalary = 30000, int $maxSalary = 80000, int $employeeCount = 3) {
        $data = RandomGenerator::restaurantLocation($minZip, $maxZip);
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->zipCode = $data['zipCode'];
        $this->isOpen = $data['isOpen'];
        
        // Generate a random number of employees (2-5) and add them to the array to recreate the restaurant employees
        $this->employees = [];
        for ($i = 0; $i < $employeeCount; $i++) {
            $this->employees[] = new Employee($minSalary, $maxSalary);
        }
    }

    public function toHTML(): string {
        $html = "<h3>{$this->name}</h3><p>{$this->getFullAddress()}</p><ul>";
        foreach ($this->employees as $e) {
            $html .= $e->toHTML();
        }
        return $html . "</ul>";
    }

    public function getFullAddress(): string {
        return "{$this->address}, {$this->city}, {$this->state} {$this->zipCode}";
    }

    public function toString(): string { return $this->name; }
    public function toMarkdown(): string { return "## {$this->name}"; }
    public function toArray(): array { return get_object_vars($this); }
}
