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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver; // Needs Symfony ^3.0
use SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentLessActionModel;
use SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentResolvingActionModel;
use SymfonyUtil\Component\HttpFoundationPOInterface\IdActionModel;

// use ... // used in string use ::class in php 7.1 symfony 4.0 version

/// @covers \SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentLessActionModel
final class ArgumentResolvingActionModelTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentResolvingActionModel',
            new ArgumentResolvingActionModel(new ArgumentResolver(), new ArgumentLessActionModel())
        );
    }

    public function testReturnsRouteNameParametersInterface()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundationPOInterface\RouteNameParametersInterface',
            (new ArgumentResolvingActionModel(new ArgumentResolver(), new ArgumentLessActionModel()))->__invoke(new Request())
        );
    }

    public function testReturnsWithId()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundationPOInterface\RouteNameParametersInterface',
            (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke($request)
        );
    }

    public function testReturnsArrayWithId()
    {
        // ((new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(new Request()))->getViewModelParameters()
        // Too much for PHP5.6, OK for 7.0
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $routeNameParameters = (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke($request);
        $this->assertArrayHasKey(
            'id',
            $routeNameParameters->getViewModelParameters()
        );
    }

    public function testReturnsNullWithId()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $routeNameParameters = (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(new Request());
        $viewModelParameters = $routeNameParameters->getViewModelParameters();
        // Too much for PHP5.6, OK for 7.0
        $this->assertNull(
            $viewModelParameters['id']
        );
    }

    public function testReturnsIdWithId()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $routeNameParameters = (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(
            $request
        );
        $viewModelParameters = $routeNameParameters->getViewModelParameters();
        // Too much for PHP5.6, OK for 7.0
        $this->assertSame(
            'Fabien',
            $viewModelParameters['id']
        );
    }
}
