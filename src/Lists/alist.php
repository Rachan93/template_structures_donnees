<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    // Propriété pour stocker les éléments de la liste
    protected array $elements;

    // Constructeur de la classe
    public function __construct()
    {
        // Initialise la liste comme un tableau vide
        $this->elements = [];
    }

    // Méthode pour afficher la liste sous forme de chaîne JSON formatée
    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    // Méthode pour ajouter un élément à la fin de la liste
    public function push(mixed $element = null): void
    {
        // Vérifie le type de l'element et génère une exception si le type n'est pas pris en charge
        if (is_null($element) && !is_scalar($element) && is_object($element) && is_array($element)) {
            throw new \InvalidArgumentException("Type d'élément non pris en charge.");
        }

        // Ajoute l'element à la liste
        $this->elements[] = $element;
    }

    // Méthode pour récupérer un élément en fonction de son index
    public function get(int $index): mixed
    {
        // Vérifie si l'indice existe dans la liste
        if (array_key_exists($index, $this->elements)) {
            return $this->elements[$index];
        }

        // Génère une exception si l'indice est hors limites
        throw new \OutOfBoundsException("Indice hors limites");
    }

    // Méthode pour remplacer un élément à un indice donné
    public function set(int $index, mixed $element): void
    {
        // Vérifie si l'indice existe dans la liste
        if (array_key_exists($index, $this->elements)) {
            $this->elements[$index] = $element;
        } else {
            // Génère une exception si l'indice est hors limites
            throw new \OutOfBoundsException("Indice hors limites");
        }
    }

    // Méthode pour vider la liste
    public function clear(): void
    {
        $this->elements = [];
    }

    // Méthode pour vérifier si un élément existe dans la liste
    public function includes(mixed $element): bool
    {
        return in_array($element, $this->elements, true);
    }

    // Méthode pour vérifier si la liste est vide
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    // Méthode pour trouver l'indice de la première occurrence d'un élément
    public function indexOf(mixed $element): int
    {
        $index = array_search($element, $this->elements, true);
        if ($index === false) {
            // Génère une exception si l'élément n'est pas trouvé
            throw new \Exception("Élément non trouvé dans la liste.");
        }
        return $index;
    }

    // Méthode pour supprimer un élément à un indice donné
    public function remove(int $index): void
    {
        // Vérifie si l'indice existe dans la liste
        if (array_key_exists($index, $this->elements)) {
            // Supprime l'élément et réindexe les clés pour maintenir une séquence continue
            unset($this->elements[$index]);
            $this->elements = array_values($this->elements);
        } else {
            // Génère une exception si l'indice est hors limites
            throw new \OutOfBoundsException("Indice hors limites");
        }
    }

    // Méthode pour obtenir le nombre d'éléments dans la liste
    public function size(): int
    {
        return count($this->elements);
    }

    // Méthode pour convertir la liste en un tableau PHP
    public function toArray(): array
    {
        return $this->elements;
    }
}