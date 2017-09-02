<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyUtil\Component\HttpFoundation;

// Similar namespace in Symfony
// https://github.com/symfony/symfony/tree/v3.3.8/src/Symfony/Component/Routing/Generator

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use SymfonyUtil\Component\HttpFoundation\ReRouteControllerModelInterface;
use SymfonyUtil\Component\HttpFoundation\ReRouteInterface;

// use SymfonyUtil\Component\HttpFoundation\ResponseParameters;

class ReRouteControllerModel implements ReRouteControllerModelInterface
{
    protected $reRoute;

    public function __construct(ReRouteInterface $reRoute)
    {
        $this->reRoute = $reRoute;
    }

    /**
     * Returns ResponseParameters to the given route with the given parameters.
     *
     * @param string $route      The name of the route
     * @param mixed  $parameters An array of parameters
     *
     * @return Response
     *
     * @see Interface ReRouteControllerModelInterface
     */
    public function __invoke($route, $parameters = [], Request $request = null)
    {
        return new ResponseParameters({}, $this->reRoute($route, $parameters));
    }
}

// Inspired from https://github.com/symfony/symfony/blob/v3.3.8/src/Symfony/Bundle/FrameworkBundle/Controller/ControllerTrait.php
