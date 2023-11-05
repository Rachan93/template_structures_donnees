<?php

namespace Opmvpc\StructuresDonnees\Stacks;

use Opmvpc\StructuresDonnees\Node;

class LinkedStack implements StackInterface
{
    protected Node $head;
    protected Node $tail;
    protected int $size;

    public function __construct()
    {
        $this->head = new Node(null);
        $this->tail = $this->head;
        $this->size = 0;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function push(mixed $element): StackInterface
    {
        $newNode = new Node($element);
        $this->tail->setNext($newNode);
        $this->tail = $newNode;
        $this->size++;
        return $this;
    }

    public function pop(): StackInterface
    {
        if ($this->isEmpty()) {
            throw new \Exception('Stack is empty');
        }

        $currentNode = $this->head;

        while ($currentNode->getNext() !== $this->tail) {
            $currentNode = $currentNode->getNext();
        }

        $currentNode->setNext(null);
        $this->tail = $currentNode;
        $this->size--;

        return $this;
    }

    public function top(): mixed
    {
        if ($this->isEmpty()) {
            throw new \Exception('Stack is empty');
        }

        return $this->tail->getElement();
    }

    public function toArray(): array
    {
        $result = [];
        $currentNode = $this->head->getNext();

        while ($currentNode !== null) {
            $result[] = $currentNode->getElement();
            $currentNode = $currentNode->getNext();
        }

        return $result;
    }


    public function clear(): void
    {
        $this->head->setNext(null);
        $this->tail = $this->head;
        $this->size = 0;
    }
}
