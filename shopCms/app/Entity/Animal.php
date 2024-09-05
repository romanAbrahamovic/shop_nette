<?php

declare(strict_types=1);

namespace App\Entity;

class Animal implements AnimalInterface, \JsonSerializable
{
    protected int $id;
    protected string $name;
    protected string $category;
    protected string $image;
    protected string $status;

    public function __construct(
        int    $id,
        string $name,
        string $category,
        string $image,
        string $status
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->image = $image;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'category' => $this->getCategory(),
            'image' => $this->getImage(),
            'status' => $this->getStatus(),
        ];
    }
}