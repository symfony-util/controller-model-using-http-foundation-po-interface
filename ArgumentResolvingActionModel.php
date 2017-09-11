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

use Symfony\Component\HttpFoundation\Request;

class ArgumentResolvingActionModel
{
    public function __construct(ArgumentResolverInterface $argumentResolver, callable $actionModel)
    {
        $this->parameters = $parameters;
        $this->response = $response;
    }

    public function __invoke(Request $request = null)
    {
        return new NullRouteNameParameters(); // RouteNameParametersInterface
    }
}
