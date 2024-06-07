<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, IngredientInRecipe>
     */
    #[ORM\OneToMany(targetEntity: IngredientInRecipe::class, mappedBy: 'ingredient')]
    private Collection $ingredientInRecipes;

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
            $ingredientInRecipe->setIngredient($this);
        }

        return $this;
    }

    public function removeIngredientInRecipe(IngredientInRecipe $ingredientInRecipe): static
    {
        if ($this->ingredientInRecipes->removeElement($ingredientInRecipe)) {
            // set the owning side to null (unless already changed)
            if ($ingredientInRecipe->getIngredient() === $this) {
                $ingredientInRecipe->setIngredient(null);
            }
        }

        return $this;
    }
}
