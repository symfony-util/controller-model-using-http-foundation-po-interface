<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyUtil\Component\HttpFoundationPOInterface;

// Similar namespace in Symfony
// https://github.com/symfony/symfony/tree/v3.3.8/src/Symfony/Component/Routing/Generator

use Symfony\Component\HttpFoundation\Request;
use SymfonyUtil\Component\HttpFoundation\ControllerModelInterface;
use SymfonyUtil\Component\HttpFoundation\ReRouteInterface;
use SymfonyUtil\Component\HttpFoundation\ResponseParameters;

// use SymfonyUtil\Component\HttpFoundation\ResponseParameters;

class ReRouteControllerModel implements ControllerModelInterface
{
    protected $reRoute;

    public function __construct(ReRouteInterface $reRoute, $actionModel, $viewModel)
    {
        $this->reRoute = $reRoute;
        $this->actionModel = $actionModel;
        $this->viewModel = $viewModel;
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
    // public function __invoke($route, $parameters = [], Request $request = null)
    public function __invoke(Request $request = null)
    {
        $actionResult = $this->actionModel->__invoke($request); // resturns RouteNameParametersInterface // php <= 5.6
        if ($actionResult->getRouteName()) {
            return new ResponseParameters([], $this->reRoute($actionResult->getRouteName(), $actionResult->getRouteParameters()));
            // TODO: To be filtered (one day) by
            // $this->viewModel[$actionResult->getRoute()](...$actionResult->getParameters())
            // Seems a bit complicated for uncertain use!
        }

        return new ResponseParameters($this->viewModel->__invoke(...$actionResult->getViewModelParameters())); // PHP 5.6+
        // return new ResponseParameters($this->viewModel->__invoke($actionResult->getViewModelParameters()));
        // .. for php varying arguments between action and view model.

        // TODO: To be filtered by viewmodel OK
    }
}

// Inspired from https://github.com/symfony/symfony/blob/v3.3.8/src/Symfony/Bundle/FrameworkBundle/Controller/ControllerTrait.php
