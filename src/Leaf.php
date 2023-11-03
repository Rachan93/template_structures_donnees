<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees;

class Leaf
{
    private int|string $key;
    private mixed $element;
    private ?Leaf $left;
    private ?Leaf $right;

    public function __construct(int|string $key, mixed $element, ?Leaf $left = null, ?Leaf $right = null)
    {
        $this->key = $key;
        $this->element = $element;
        $this->left = $left;
        $this->right = $right;
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function setKey(int|string $key): void
    {
        $this->key = $key;
    }

    public function getElement(): mixed
    {
        return $this->element;
    }

    public function setElement(mixed $element): void
    {
        $this->element = $element;
    }

    public function getLeft(): ?Leaf
    {
        return $this->left;
    }

    public function setLeft(?Leaf $left): void
    {
        $this->left = $left;
    }

    public function getRight(): ?Leaf
    {
        return $this->right;
    }

    public function setRight(?Leaf $right): void
    {
        $this->right = $right;
    }
}
