<?php

declare(strict_types=1);

namespace App\Routing;

use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    public function create(): RouteList
    {
        $router = new RouteList();

        $router->addRoute('/api/v1/animal/add', 'Api:Animal:add');
        $router->addRoute('/api/v1/animal/status/<status>', 'Api:Animal:getByStatus');
        $router->addRoute('/api/v1/animal/update', 'Api:Animal:update');
        $router->addRoute('/api/v1/animal/delete/<id>', 'Api:Animal:delete');

        return $router;
    }
}
