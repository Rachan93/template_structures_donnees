<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

use Opmvpc\StructuresDonnees\Node;

class LinkedList implements ListInterface
{
    protected Node $head;
    protected int $size;

    public function __construct()
    {
        $this->head = new Node(null);
        $this->size = 0;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function push(mixed $element): void {
        
        if ($this->size === 0 || gettype($element) === gettype($this->head->getNext()->getElement())) {
            $newNode = new Node($element);
            $current = $this->head;
    
            while ($current->getNext() !== null) {
                $current = $current->getNext();
            }
    
            $current->setNext($newNode);
            $this->size++;
        } else {
            throw new \InvalidArgumentException("Type of the input element is different from the type of the existing elements.");
        }
    }
    
    

    
   

   public function get(int $index): mixed {
    if ($index < 0 || $index >= $this->size) {
        throw new \OutOfBoundsException("Specified index out of bounds");
    }

    $current = $this->head->getNext();
    for ($i = 0; $i < $index; $i++) {
        $current = $current->getNext();
    }

    return $current->getElement();
}


    public function set(int $index, mixed $element): void {
        if ($index < 0 || $index >= $this->size) {
            throw new \OutOfBoundsException("Specified index out of bounds");
        }
    
        $current = $this->head->getNext();
        for ($i = 0; $i < $index; $i++) {
            $current = $current->getNext();
        }
    
        $current->setElement($element);
    }
    

    public function clear(): void {
        $this->head = new Node(null);
        $this->size = 0;
    }

    public function includes(mixed $element): bool {
        
        $current = $this->head->getNext();

        while ($current !== null) {
            
            if ($current->getElement() === $element) {
                return true;
            }
                $current = $current->getNext();        
        }
        return false;
    }

    public function isEmpty(): bool {
        if($this->size === 0){
            return true;
        }else{
            return false;
        }
    }

    public function indexOf(mixed $element): int {
        
        $current = $this->head->getNext();
        $i = 0;
        while ($current !== null) { //oui je sais j'aurais pu utiliser une boucle for mais flemme (et le recyclage c'est bon pour la planète !), et puis aussi ce tas de merde est plus marrant :)
            
            if ($current->getElement() === $element) {
                return $i;
            }
                $current = $current->getNext();
                $i++;        
        }
        
    }
    

    public function remove(int $index): void {
        
        $current = $this->head;
        
        for ($i = 0; $i < $index; $i++) {
            if ($current->getNext() === null) {
                throw new \Exception("Specified index out of bounds");
            }
                $current = $current->getNext();
            }
        
        $current->setNext($current->getNext()->getNext());
        $this->size--;
        }
        
    

    public function size(): int {
        return $this->size;
    }

    public function toArray(): array {}
}
