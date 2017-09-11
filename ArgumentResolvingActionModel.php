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
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;

class ArgumentResolvingActionModel
{
    protected $argumentResolver;
    protedted $actionModel;

    public function __construct(ArgumentResolverInterface $argumentResolver, callable $actionModel)
    {
        $this->argumentResolver = $argumentResolver;
        $this->actionModel = $actionModel;
    }

    public function __invoke(Request $request = null)
    {
        // controller arguments (adapeted from Symfony HttpKernel)
        $arguments = $this->argumentResolver->getArguments($request, $this->actionModel);
        // $event = new FilterControllerArgumentsEvent($this, $controller, $arguments, $request, $type);
        // $this->dispatcher->dispatch(KernelEvents::CONTROLLER_ARGUMENTS, $event);
        // $controller = $event->getController();
        // $arguments = $event->getArguments();
        // call controller (adapeted from Symfony HttpKernel)

        return call_user_func_array($this->actionModel, $arguments);
    }
}
