<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Faker\Factory;

class RandomGenerator {
    private static array $jobTitles = ['Chef', 'Waiter', 'Manager', 'Bartender', 'Host', 'Cook', 'Cashier', 'Server', 'Dishwasher', 'Supervisor'];
    private static array $cuisineTypes = ['Italian', 'Japanese', 'Chinese', 'Mexican', 'French', 'American', 'Thai', 'Indian', 'Korean', 'Vietnamese'];
    private static array $awards = ['Employee of the Month', 'Best Service Award', 'Excellence in Hospitality', 'Customer Choice Award', 'Top Performer'];

    private static function getFaker() {
        // use en_US locale for consistency
        return Factory::create('en_US');
    }

    public static function user(): array {
        $faker = self::getFaker();
        return [
            'id' => $faker->numberBetween(1, 9999),
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'email' => $faker->unique()->safeEmail(),
            'phoneNumber' => $faker->phoneNumber(),
            'address' => $faker->streetAddress(),
            'birthDate' => new DateTime($faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d')),
            'membershipExpirationDate' => new DateTime($faker->dateTimeBetween('now', '+3 years')->format('Y-m-d')),
            'role' => $faker->randomElement(['admin', 'user', 'user', 'user', 'user'])
        ];
    }

    public static function employee(int $minSalary = 30000, int $maxSalary = 80000): array {
        $faker = self::getFaker();
        return [
            'jobTitle' => $faker->randomElement(self::$jobTitles),
            // Add argument to allow user to set salary
            'salary' => $faker->numberBetween($minSalary, $maxSalary),
            'startDate' => new DateTime($faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d')),
            'awards' => $faker->boolean(30) ? [$faker->randomElement(self::$awards)] : []
        ];
    }

    public static function company(): array {
        $faker = self::getFaker();
        return [
            'name' => $faker->company(),
            'foundingYear' => $faker->numberBetween(1980, 2020),
            'description' => $faker->catchPhrase() . '. ' . $faker->bs(),
            'website' => $faker->url(),
            'phone' => $faker->phoneNumber(),
            'industry' => 'Food & Beverage',
            'ceo' => $faker->name(),
            'isPubliclyTraded' => $faker->boolean(),
            'country' => 'Japan',
            'founder' => $faker->name(),
            'totalEmployees' => $faker->numberBetween(50, 10000)
        ];
    }

    public static function restaurantLocation(int $minZip = 10000, int $maxZip = 99999): array {
        $faker = self::getFaker();
        $city = $faker->city();
        return [
            'name' => $city . ' ' . $faker->randomElement(['Branch', 'Store', 'Location', 'Outlet']),
            'address' => $faker->streetAddress(),
            'city' => $city,
            'state' => $faker->state(),
            // Add argument to allow user to set zip code range
            'zipCode' => $faker->numberBetween($minZip, $maxZip),
            'isOpen' => $faker->boolean(90)
        ];
    }

    public static function restaurantChain(): array {
        $faker = self::getFaker();
        return [
            'chainId' => $faker->numberBetween(1000, 9999),
            'cuisineType' => $faker->randomElement(self::$cuisineTypes),
            'numberOfLocations' => $faker->numberBetween(5, 50),
            'hasDriveThru' => $faker->boolean(),
            'yearFounded' => $faker->numberBetween(1980, 2020),
            'parentCompany' => $faker->boolean(30) ? $faker->company() . ' Holdings' : ''
        ];
    }
}
