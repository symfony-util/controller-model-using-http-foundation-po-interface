<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;
use SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentResolvingActionModel;

// use ... // used in string use ::class in php 7.1 symfony 4.0 version

/// @covers \SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentLessActionModel
final class ArgumentResolvingActionModelTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentResolvingActionModel',
            new ArgumentResolvingActionModel()
        );
    }

    public function testReturnsRouteNameParametersInterface()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundationPOInterface\RouteNameParametersInterface',
            (new ArgumentResolvingActionModel())->__invoke()
        );
    }
}