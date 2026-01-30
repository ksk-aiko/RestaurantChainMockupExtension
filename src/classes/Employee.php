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
        $startDate = $this->getStartDateFormatted('Y-m-d');
        $awardsCount = count($this->awards);

        return "<li class='list-group-item'>" .
               "<div class='d-flex justify-content-between align-items-start'>" .
               "<div class='ms-2 me-auto'>" .
               "<div class='fw-bold'>{$name}</div>" .
               "<small class='text-muted'>{$this->jobTitle}</small>" .
               "</div>" .
               "<span class='badge bg-secondary rounded-pill'>\${$this->salary}</span>" .
               "</div>" .
               "<small class='text-muted'>Started: {$startDate} | Awards: {$awardsCount}</small>" .
               "</li>";
    }

    public function getFullName(): string {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getStartDateFormatted(string $format = 'Y-m-d'): string {
        return $this->startDate->format($format);
    }
}
