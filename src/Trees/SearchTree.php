<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Trees;

use Opmvpc\StructuresDonnees\Leaf;
use Opmvpc\StructuresDonnees\Stacks\ArrayStack;

class SearchTree implements TreeInterface
{
    protected ?Leaf $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function isEmpty(): bool
    {
        return $this->root === null;
    }

    public function insert(int|string $key, mixed $element): TreeInterface
    {
        $newLeaf = new Leaf($key, $element);

        if ($this->root === null) {
            $this->root = $newLeaf;
        } else {
            $this->insertRecursive($this->root, $newLeaf);
        }

        return $this;
    }

    protected function insertRecursive(?Leaf &$node, Leaf $newLeaf): void
    {
        if ($node === null) {
            $node = $newLeaf;
        } elseif ($newLeaf->getKey() === $node->getKey()) {
            $node->setElement($newLeaf->getElement());
        } elseif ($newLeaf->getKey() < $node->getKey()) {
            $this->insertRecursive($node->getLeft(), $newLeaf);
        } else {
            $this->insertRecursive($node->getRight(), $newLeaf);
        }
    }

    public function search(int|string $key): mixed
    {
        if ($this->isEmpty()) {
            throw new \Exception('Tree is empty');
        }

        return $this->searchRecursive($this->root, $key);
    }

    protected function searchRecursive(?Leaf $node, int|string $key): mixed
    {
        if ($node === null) {
            return null;
        }

        if ($key === $node->getKey()) {
            return $node->getElement();
        }

        if ($key < $node->getKey()) {
            return $this->searchRecursive($node->getLeft(), $key);
        }

        return $this->searchRecursive($node->getRight(), $key);
    }

    public function min(): mixed
    {
        if ($this->isEmpty()) {
            throw new \Exception('Tree is empty');
        }

        return $this->findMin($this->root);
    }

    protected function findMin(?Leaf $node): mixed
    {
        while ($node->getLeft() !== null) {
            $node = $node->getLeft();
        }

        return $node->getElement();
    }

    public function max(): mixed
    {
        if ($this->isEmpty()) {
            throw new \Exception('Tree is empty');
        }

        return $this->findMax($this->root);
    }

    protected function findMax(?Leaf $node): mixed
    {
        while ($node->getRight() !== null) {
            $node = $node->getRight();
        }

        return $node->getElement();
    }

    public function toArray(): array
    {
        return $this->toArrayRecursive($this->root);
    }
    
    protected function toArrayRecursive(?Leaf $node): array
    {
        if ($node === null) {
            return [];
        }
    
        return array_merge(
            $this->toArrayRecursive($node->getLeft()),
            [$node->getKey() => $node->getElement()],
            $this->toArrayRecursive($node->getRight())
        );
    }
    

}
