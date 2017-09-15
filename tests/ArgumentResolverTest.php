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
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory;
use SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentResolvingActionModel;
use SymfonyUtil\Component\HttpFoundationPOInterface\IdActionModel;

// use ... // used in string use ::class in php 7.1 symfony 4.0 version

/// @covers \SymfonyUtil\Component\HttpFoundationPOInterface\ArgumentLessActionModel
final class ArgumentResolverTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpKernel\Controller\ArgumentResolver',
            new ArgumentResolver()
        );
    }

    public function testCanBeCreatedAsInterface()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface',
            new ArgumentResolver()
        );
    }

    public function testMetadataNotNull()
    {
        var_dump((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()));
        $this->assertNotNull(
            (new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel())
        );
    }

    public function testMetadata()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata',
            ((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()))[0]
        );
    }

    public function testMetadataName()
    {
        $this->assertSame(
            'id',
            (((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()))[0])->getName()
        );
    }

    public function RequestQuery() // unused
    {
        $this->assertSame(
            'Fabien',
            Request::create('/', 'GET', ['id' => 'Fabien'])->query->get('id')
        );
    }

    public function testRequestAttribute()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $this->assertSame(
            'Fabien',
            $request->attributes->get('id')
        );
    }

    public function testMetadataRequest()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $this->assertSame(
            'Fabien',
            $request->attributes->get(
                (((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()))[0])->getName()
            )
        );
    }

    public function testMetadataRequestAttributeValueResolverSupports()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        var_dump((new RequestAttributeValueResolver())->supports(
                $request,
                ((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()))[0]
            )
        );
        $this->assertTrue(
            (new RequestAttributeValueResolver())->supports(
                $request,
                ((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()))[0]
            )
        );
    }

    public function testMetadataRequestAttributeValueResolverResolve()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $this->assertSame(
            'Fabien',
            (new RequestAttributeValueResolver())->resolve(
                $request,
                ((new ArgumentMetadataFactory())->createArgumentMetadata(new IdActionModel()))[0]
            )
        );
    }

    public function testReturnsArrayWithId()
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        var_dump((new ArgumentResolver())->getArguments(
                // new Request(),
                $request,
                [new IdActionModel(), '__invoke']
        ));
        // ((new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(new Request()))->getViewModelParameters()
        // Too much for PHP5.6, OK for 7.0
        // $routeNameParameters = (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(new Request());
        $this->assertArrayHasKey(
            'id',
            (new ArgumentResolver())->getArguments(
                // new Request(),
                $request,
                [new IdActionModel(), '__invoke']
            )
        );
    }

    public function ReturnsNullWithId() ///
    {
        $routeNameParameters = (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(new Request());
        $viewModelParameters = $routeNameParameters->getViewModelParameters();
        // Too much for PHP5.6, OK for 7.0
        $this->assertNull(
            $viewModelParameters['id']
        );
    }

    public function ReturnsIdWithId() ///
    {
        $request = new Request();
        $request->attributes->set('id', 'Fabien');
        $routeNameParameters = (new ArgumentResolvingActionModel(new ArgumentResolver(), new IdActionModel()))->__invoke(
            Request::create('/', 'GET', ['id' => 'Fabien'])
        );
        $viewModelParameters = $routeNameParameters->getViewModelParameters();
        // Too much for PHP5.6, OK for 7.0
        $this->assertSame(
            'Fabien',
            $viewModelParameters['id']
        );
    }
}
