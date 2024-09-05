<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AnimalInterface;

interface AnimalRepositoryInterface
{
    public function add(AnimalInterface $animal): void;
    public function getByStatus(string $status): array;
    public function find(int $id): ?AnimalInterface;
    public function update(AnimalInterface $animal): void;
    public function delete(int $id): void;
}