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

interface RouteNameParametersInterface
{
    /// @return string
    public function getRouteName();

    /// @return array
    public function getRouteParameters();

    /// @return array
    public function getViewModelParameters();
}

// Considere testing this way:
// https://github.com/php-fig/log/blob/master/Psr/Log/Test/LoggerInterfaceTest.php
