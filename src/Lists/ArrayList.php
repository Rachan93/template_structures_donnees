<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    public function push(mixed $element = null): void {
        $this->elements[] = $element;
    }

    public function get(int $index): mixed {
        return $this->elements[$index];
    }

    public function set(int $index, mixed $element): void {
        $this->elements[$index] = $element;
    }

    public function clear(): void {
        $this->elements = [];
    }

    public function includes(mixed $element): bool {}

    public function isEmpty(): bool {}

    public function indexOf(mixed $element): int {
        foreach($this->elements as $key => $value){
            if($value === $element){
                return $key;
            }
        }
    }
    public function remove(int $index): void {
       unset($this->elements[$index]);
    }

    public function size(): int {
        return count($this->elements);
    }

    public function toArray(): array {}
}
