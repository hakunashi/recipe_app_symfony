<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $preparationTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $restTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $cookTime = null;

    /**
     * @var Collection<int, IngredientInRecipe>
     */
    #[ORM\OneToMany(targetEntity: IngredientInRecipe::class, mappedBy: 'recipe')]
    private Collection $ingredientInRecipes;

    #[ORM\Column]
    private ?int $nbStep = null;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function __construct()
    {
        $this->ingredientInRecipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): static
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getRestTime(): ?int
    {
        return $this->restTime;
    }

    public function setRestTime(?int $restTime): static
    {
        $this->restTime = $restTime;

        return $this;
    }

    public function getCookTime(): ?int
    {
        return $this->cookTime;
    }

    public function setCookTime(?int $cookTime): static
    {
        $this->cookTime = $cookTime;

        return $this;
    }

    /**
     * @return Collection<int, IngredientInRecipe>
     */
    public function getIngredientInRecipes(): Collection
    {
        return $this->ingredientInRecipes;
    }

    public function addIngredientInRecipe(IngredientInRecipe $ingredientInRecipe): static
    {
        if (!$this->ingredientInRecipes->contains($ingredientInRecipe)) {
            $this->ingredientInRecipes->add($ingredientInRecipe);
            $ingredientInRecipe->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredientInRecipe(IngredientInRecipe $ingredientInRecipe): static
    {
        if ($this->ingredientInRecipes->removeElement($ingredientInRecipe)) {
            // set the owning side to null (unless already changed)
            if ($ingredientInRecipe->getRecipe() === $this) {
                $ingredientInRecipe->setRecipe(null);
            }
        }

        return $this;
    }

    public function getNbStep(): ?int
    {
        return $this->nbStep;
    }

    public function setNbStep(int $nbStep): static
    {
        $this->nbStep = $nbStep;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
