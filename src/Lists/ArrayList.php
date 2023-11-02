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
        if(count($this->elements) !== 0 && gettype($element) !== gettype($this->elements[0])){
            throw new \InvalidArgumentException("Type of the input element is different from the type of the existing elements.");
        }
       else{ $this->elements[] = $element;
       }
    }

    public function get(int $index): mixed {
        if ($index < 0 || $index >= count($this->elements)) {
            throw new \InvalidArgumentException("Couldn't get any value at specified index");
        } else {
            return $this->elements[$index];
        }
    }

    public function set(int $index, mixed $element): void {
        if(count($this->elements) === 0){
            throw new \InvalidArgumentException("Couldn't set the value at specified index");
        }else{
        $this->elements[$index] = $element;
        }
    }

    public function clear(): void {
        $this->elements = [];
    }

    public function includes(mixed $element): bool {
        return in_array($element, $this->elements, true);
    }

    public function isEmpty(): bool {
        return empty($this->elements);
    }

    public function indexOf(mixed $element): int {
        if(count($this->elements) === 0){
            throw new \InvalidArgumentException("Couldn't find an index corresponding to specified value");
        
        }else{
        
            foreach($this->elements as $key => $value){
                if($value === $element){
                    return $key;
                }
            }
        }
    }
    public function remove(int $index): void {
        if(count($this->elements) === 0){
            throw new \InvalidArgumentException("Couldn't remove value at specified index");
        
        }else{
       unset($this->elements[$index]);
       $this->elements = array_values($this->elements);
        }
    }

    public function size(): int {
        return count($this->elements);
    }

    public function toArray(): array {
        return $this->elements;
    }
}
