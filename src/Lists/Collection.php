<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class Collection extends ArrayList implements CollectionInterface
{
    public function map(callable $callback): CollectionInterface
    {
        $mappedCollection = new Collection();

        foreach ($this->elements as $index => $element) {
            $mappedCollection->push($callback($element, $index));
        }

        return $mappedCollection;
    }
    

    public function filter(callable $callback): CollectionInterface
    {
        $filteredCollection = new Collection();

        foreach ($this->elements as $index => $element) {
            if ($callback($element, $index)) {
                $filteredCollection->push($element);
            }
        }

        return $filteredCollection;
    }
    

    public function reduce(callable $callback, mixed $initial = null): mixed {
        $accumulator = $initial;
    
        foreach ($this->elements as $element) {
            $accumulator = $callback($accumulator, $element);
        }
    
        return $accumulator;
    }
    

    public function forEach(callable $callback): void
    {
        foreach ($this->elements as $index => $element) {
            $callback($element, $index);
        }
    }
    

    public function some(callable $callback): bool
    {
        foreach ($this->elements as $index => $element) {
            if ($callback($element, $index)) {
                return true;
            }
        }

        return false;
    }
    
    public function every(callable $callback): bool
    {
        foreach ($this->elements as $index => $element) {
            if (!$callback($element, $index)) {
                return false;
            }
        }

        return true;
    }
    

    public function find(callable $callback): mixed
    {
        foreach ($this->elements as $index => $element) {
            if ($callback($element, $index)) {
                return $element;
            }
        }

        return null;
    }
    

    public function findIndex(callable $callback): int
    {
        foreach ($this->elements as $index => $element) {
            if ($callback($element, $index)) {
                return $index;
            }
        }

        return -1;
    }
    

    public function join(string $separator = ', '): string {
        return implode($separator, $this->elements);
    }
    
    

    public function reverse(): CollectionInterface
    {
        $reversedElements = array_reverse($this->elements);
        $reversedCollection = new self();
        $reversedCollection->elements = $reversedElements;
        return $reversedCollection;
    }
    

    
    
    

    public function sort(callable $callback = null): CollectionInterface {
        if ($callback !== null) {
            usort($this->elements, $callback);
        } else {
            sort($this->elements);
        }
        return $this;
    }
    
    

    public function concat(...$collections): CollectionInterface {
        foreach ($collections as $collection) {
            $this->elements = array_merge($this->elements, $collection->toArray());
        }
        return $this;
    }
    
    

    public function fill(mixed $value = null, int $start = 0, ?int $end = null): CollectionInterface
    {
        $end = $end ?? $this->size();
    
        $filledElements = $this->elements;
    
        for ($i = $start; $i < $end; $i++) {
            if (isset($filledElements[$i])) {
                $filledElements[$i] = $value;
            } else {
                $filledElements[] = $value;
            }
        }
    
        $filledCollection = new self();
        $filledCollection->elements = $filledElements;
    
        return $filledCollection;
    }
    

    
}
