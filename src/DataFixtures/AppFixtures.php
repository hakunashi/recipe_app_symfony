<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    private const CATEGORIES = ["Entrée", "Plats", "Dessert", "Amuse bouche", "Sauce", "Accompagnement"];
    private const DIFFICULTIES = ["Simple", "Moyen", "Difficile"];
    private const PRICES = ["Bon marché", "Accessible", "Chère"];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create();

        $categories = [];

        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
            $categories[] = $category;
        }

        for($i = 0; $i < 20; $i++) {
            $recipe = new Recipe();
            $recipe
                ->setName($faker->words($faker->numberBetween(4, 7), true))
                ->setDifficulty($faker->randomElement(self::DIFFICULTIES))
                ->setPrice($faker->randomElement(self::PRICES))
                ->setPreparationTime($faker->numberBetween(5, 30))
                ->setRestTime($faker->numberBetween(5, 30))
                ->setCookTime($faker->numberBetween(5, 30))
                ->setCategory($faker->randomElement($categories))
                ->setNbStep($faker->numberBetween(1, 7));

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
