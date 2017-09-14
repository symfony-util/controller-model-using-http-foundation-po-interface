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

// TODO: Move to POI

class RouteNameParameters implements RouteNameParametersInterface
{
    protected $routeName;
    protected $routeParameters;
    protected $viewModelParameters;

    /// @param string $routeName
    public function __construct($routeName, array $routeParameters, array $viewModelParameters)
    {
        $this->routeName = $routeName;
        $this->routeParameters = $routeParameters;
        $this->viewModelParameters = $viewModelParameters;
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function getRouteParameters()
    {
        return $this->routeParameters;
    }

    public function getViewModelParameters()
    {
        return $this->viewModelParameters;
    }
}
