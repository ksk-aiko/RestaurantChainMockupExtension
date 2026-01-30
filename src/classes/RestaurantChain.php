<?php
require_once 'Company.php';
require_once 'RestaurantLocation.php';
require_once __DIR__ . '/../../Helpers/RandomGenerator.php';

class RestaurantChain extends Company {
    public int $chainId;
    public array $restaurantLocations;
    public string $cuisineType;
    public int $numberOfLocations;
    public bool $hasDriveThru;
    public int $yearFounded;
    public string $parentCompany;

    // Modify constructor to accept number of locations, employee salary range, and zip code range
    public function __construct(int $numberOfLocations = 5, int $minSalary = 30000, int $maxSalary = 80000, int $minZip = 10000, int $maxZip = 99999, int $employeeCount = 3) {
        parent::__construct();
        $data = RandomGenerator::restaurantChain();
        $this->chainId = $data['chainId'];
        $this->cuisineType = $data['cuisineType'];
        $this->numberOfLocations = $numberOfLocations;
        $this->hasDriveThru = $data['hasDriveThru'];
        $this->yearFounded = $data['yearFounded'];
        $this->parentCompany = $data['parentCompany'];
        
        // Generate a random number of restaurants (2-5) and add them to the array to recreate the restaurant chain
        $this->restaurantLocations = [];
        for ($i = 0; $i < $numberOfLocations; $i++) {
            $this->restaurantLocations[] = new RestaurantLocation($minZip, $maxZip, $minSalary, $maxSalary, $employeeCount);
        }
    }

    public function toHTML(): string {
        $html = parent::toHTML();
        foreach ($this->restaurantLocations as $loc) {
            $html .= $loc->toHTML();
        }
        return $html;
    }
}
