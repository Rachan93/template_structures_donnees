<?php

namespace Opmvpc\StructuresDonnees\Stacks;

class ArrayStack implements StackInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function isEmpty(): bool
    {
        if(count($this->elements) === 0){
            return true;
        }else{
            return false;
        }

    }

    public function push(mixed $element): StackInterface
    {
        $this->elements[] = $element;
        return $this;
    }

    public function pop(): StackInterface
    {
        if ($this->isEmpty()) {
            throw new \Exception('Stack is empty');
        }

        array_pop($this->elements);
        return $this;
    }

    public function top(): mixed
    {
        if ($this->isEmpty()) {
            throw new \Exception('Stack is empty');
        }

        return end($this->elements);
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    public function clear(): void
    {
        $this->elements = [];
    }
}
