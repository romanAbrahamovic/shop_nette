<?php

declare(strict_types=1);

namespace App\Entity;

interface AnimalInterface
{
    public function getId(): int;
    public function getName(): string;
    public function getCategory(): string;
    public function getImage(): string;
    public function getStatus(): string;
}