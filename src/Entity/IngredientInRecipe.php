<?php

namespace App\Entity;

use App\Repository\IngredientInRecipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientInRecipeRepository::class)]
class IngredientInRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ingredientInRecipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'ingredientInRecipes')]
    private ?Ingredient $ingredient = null;

    #[ORM\Column]
    private ?int $ingredientQuantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getIngredientQuantity(): ?int
    {
        return $this->ingredientQuantity;
    }

    public function setIngredientQuantity(int $ingredientQuantity): static
    {
        $this->ingredientQuantity = $ingredientQuantity;

        return $this;
    }
}
