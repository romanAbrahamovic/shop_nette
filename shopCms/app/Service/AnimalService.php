<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\AnimalInterface;
use App\Repository\AnimalRepositoryInterface;
use App\Repository\XmlAnimalRepository;

class AnimalService
{
    private XmlAnimalRepository $animalRepository;

    public function __construct(AnimalRepositoryInterface $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    public function addAnimal(AnimalInterface $animal): void
    {
        $this->animalRepository->add($animal);
    }

    public function getAnimalsByStatus(string $status): array
    {
        return $this->animalRepository->getByStatus($status);
    }

    public function updateAnimal(AnimalInterface $animal): void
    {
        $this->animalRepository->update($animal);
    }

    public function deleteAnimal(int $id): void
    {
        $this->animalRepository->delete($id);
    }
}
