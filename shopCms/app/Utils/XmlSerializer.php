<?php

declare(strict_types=1);

namespace App\Utils;

use App\Entity\Animal;
use App\Utils\Exception\CannotLoadXMLFileException;
use SimpleXMLElement;

class XmlSerializer
{
    public function deserialize(string $filePath): array
    {
        $xml = simplexml_load_file($filePath);

        if ($xml === false) {
            throw new CannotLoadXMLFileException('Cannot load XML file');
        }

        $animals = [];
        foreach ($xml->animal as $animalData) {
            $animals[] = new Animal(
                (int)$animalData->id,
                (string)$animalData->name,
                (string)$animalData->category,
                (string)$animalData->image,
                (string)$animalData->status
            );
        }
        return $animals;
    }

    public function serialize(string $filePath, array $animals): void
    {
        $xml = new SimpleXMLElement('<animals/>');
        foreach ($animals as $animal) {
            $animalNode = $xml->addChild('animal');
            $animalNode->addChild('id', (string)$animal->getId());
            $animalNode->addChild('name', $animal->getName());
            $animalNode->addChild('category', $animal->getCategory());
            $animalNode->addChild('image', $animal->getImage());
            $animalNode->addChild('status', $animal->getStatus());
        }
        $xml->asXML($filePath);
    }
}