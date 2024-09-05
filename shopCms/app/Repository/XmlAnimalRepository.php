<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AnimalInterface;
use App\Utils\XmlSerializer;

class XmlAnimalRepository implements AnimalRepositoryInterface
{
    private XmlSerializer $serializer;

    public function __construct(private string $xmlFilePath,
                                XmlSerializer  $serializer)
    {
        $this->serializer = $serializer;
    }

    public function add(AnimalInterface $animal): void
    {
        $animals = $this->serializer->deserialize($this->xmlFilePath);
        $animals[] = $animal;
        $this->serializer->serialize($this->xmlFilePath, $animals);
    }

    public function getByStatus(string $status): array
    {
        $animals = $this->serializer->deserialize($this->xmlFilePath);
        return array_filter($animals, fn($animal) => $animal->getStatus() === $status);
    }

    public function find(int $id): ?AnimalInterface
    {
        $animals = $this->serializer->deserialize($this->xmlFilePath);
        foreach ($animals as $animal) {
            if ($animal->getId() === $id) {
                return $animal;
            }
        }
        return null;
    }

    public function update(AnimalInterface $animal): void
    {
        $animals = $this->serializer->deserialize($this->xmlFilePath);
        foreach ($animals as &$existingAnimal) {
            if ($existingAnimal->getId() === $animal->getId()) {
                $existingAnimal = $animal;
                break;
            }
        }
        $this->serializer->serialize($this->xmlFilePath, $animals);
    }

    public function delete(int $id): void
    {
        $animals = $this->serializer->deserialize($this->xmlFilePath);
        $animals = array_filter($animals, fn($animal) => $animal->getId() !== $id);
        $this->serializer->serialize($this->xmlFilePath, $animals);
    }

}