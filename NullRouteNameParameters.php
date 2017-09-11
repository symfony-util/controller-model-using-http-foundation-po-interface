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

class NullRouteNameParameters implements RouteNameParametersInterface
{
    public function getRouteName()
    {
        return '';
    }

    public function getRouteParameters()
    {
        return [];
    }

    public function getViewModelParameters()
    {
        return [];
    }
}
