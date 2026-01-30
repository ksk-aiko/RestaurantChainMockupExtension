<?php
require_once 'User.php';
require_once __DIR__ . '/../../Helpers/RandomGenerator.php';

// Employee class inheriting from User class
class Employee extends User {
    // Add Employee-specific properties
    public string $jobTitle;
    public float $salary;
    public DateTime $startDate;
    public array $awards;

    public function __construct(int $minSalary = 30000, int $maxSalary = 80000) {
        parent::__construct();
        $data = RandomGenerator::employee($minSalary, $maxSalary);
        $this->jobTitle = $data['jobTitle'];
        $this->salary = $data['salary'];
        $this->startDate = $data['startDate'];
        $this->awards = $data['awards'];
    }

    public function toHTML(): string {
        $name = $this->getFullName();
        return "<li>{$this->jobTitle} - {$name}</li>";
    }

    public function getFullName(): string {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getStartDateFormatted(string $format = 'Y-m-d'): string {
        return $this->startDate->format($format);
    }
}
