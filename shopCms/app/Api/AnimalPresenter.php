<?php

declare(strict_types=1);

namespace App\Api;

use App\Http\ApiResponseFormatter;
use App\Utils\Exception\CannotLoadXMLFileException;
use Contributte\ApiRouter\ApiRoute;
use Nette\Application\UI\Presenter;
use App\Service\AnimalService;
use App\Entity\Animal;

class AnimalPresenter extends Presenter
{
    public function __construct(private readonly AnimalService        $animalService,
                                private readonly ApiResponseFormatter $apiResponseFormatter)
    {
        parent::__construct();
    }

    /**
     *
     * @ApiRoute(
     *  "/api/v1/animal/add",
     *  methods={"POST"}
     * )
     *
     * - **URL**: `/api/v1/animal/add`
     * - **Method**: `POST`
     * - **Description**: Adds a new animal to the system.
     * - **Request body**:
     *     - `id` (int): Unique identifier for the animal
     *     - `name` (string): Name of the animal
     *     - `category` (string): Category (e.g., dog, cat)
     *     - `image` (string): URL of the animal's image
     *     - `status` (string): Status of the animal (e.g., available, sold)
     * - **Response**:
     *     - `status`: success message
     *     - `message`: confirmation message
     *     - `animal`: information about the added animal
     */
    public function actionAdd(): void
    {
        try {
            $data = json_decode($this->getHttpRequest()->getRawBody(), true);
            $animal = new Animal($data['id'], $data['name'], $data['category'], $data['image'], $data['status']);
            $this->animalService->addAnimal($animal);

            $this->sendJson($this->apiResponseFormatter->formatMessage('Animal added successfully'));
        } catch (CannotLoadXMLFileException $e) {
            $this->sendJson($this->apiResponseFormatter->formatException($e));
        }


    }

    /**
     *
     * @ApiRoute(
     *  "/api/v1/animal/status/{status}",
     *  methods={"GET"}
     * )
     *
     * - **URL**: `/api/v1/animal/status/{status}`
     * - **Method**: `GET`
     * - **Description**: Fetches animals by their status (e.g., available, sold).
     * - **Request params**:
     *     - `status` (string): The status of the animals to filter by (e.g., available, sold).
     * - **Response**:
     *     - `status`: success message
     *     - `data`: list of animals that match the given status
     */
    public function actionGetByStatus(string $status): void
    {
        try {
            $animals =$this->animalService->getAnimalsByStatus($status);
            $this->sendJson($this->apiResponseFormatter->formatPayload($animals, 'Animals retrieved successfully'));
        } catch (CannotLoadXMLFileException $e) {
            $this->sendJson($this->apiResponseFormatter->formatException($e));
        }
    }

    /**
     *
     * @ApiRoute(
     *  "/api/v1/animal/update",
     *  methods={"PUT"}
     * )
     *
     * - **URL**: `/api/v1/animal/update`
     * - **Method**: `PUT`
     * - **Description**: Updates an animal's information in the system.
     * - **Request body**:
     *     - `id` (int): Unique identifier for the animal
     *     - `name` (string): Name of the animal
     *     - `category` (string): Category (e.g., dog, cat)
     *     - `image` (string): URL of the animal's image
     *     - `status` (string): Status of the animal (e.g., available, sold)
     * - **Response**:
     *     - `status`: success message
     *     - `message`: confirmation message
     */
    public function actionUpdate(): void
    {
        try {
            $data = json_decode($this->getHttpRequest()->getRawBody(), true);
            $animal = new Animal($data['id'], $data['name'], $data['category'], $data['image'], $data['status']);
            $this->animalService->updateAnimal($animal);

            $this->sendJson($this->apiResponseFormatter->formatMessage('Animal updated successfully'));
        } catch (CannotLoadXMLFileException $e) {
            $this->sendJson($this->apiResponseFormatter->formatException($e));
        }
    }

    /**
     *
     * @ApiRoute(
     *  "/api/v1/animal/delete/{id}",
     *  methods={"DELETE"}
     * )
     *
     * - **URL**: `/api/v1/animal/delete/{id}`
     * - **Method**: `DELETE`
     * - **Description**: Deletes an animal from the system based on its ID.
     * - **Request params**:
     *     - `id` (int): The unique identifier of the animal to be deleted.
     * - **Response**:
     *     - `status`: success message
     *     - `message`: confirmation message
     */
    public function actionDelete(int $id): void
    {
        try {
            $this->animalService->deleteAnimal($id);

            $this->sendJson($this->apiResponseFormatter->formatMessage('Animal deleted successfully'));
        } catch (CannotLoadXMLFileException $e) {
            $this->sendJson($this->apiResponseFormatter->formatException($e));
        }
    }
}
