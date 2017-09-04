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
use SymfonyUtil\Component\HttpFoundation\ControllerModelInterface;
use SymfonyUtil\Component\HttpFoundation\ResponseParameters;

class ControllerModel implements ControllerModelInterface // interface in SU//HttpF
{
    protected $actionModel; // interface in (SU//HttpF) + POI(return type (php 7 -> s4 + php 7.1)
    protected $viewModel; // interface in POI

    public function __construct($actionModel, $viewModel)
    {
        $this->actionModel = $actionModel;
        $this->viewModel = $viewModel;
    }

    public function __invoke(Request $request = null)
    {
        return new ResponseParameters($this->viewModel->__invoke(...$this->actionModel($request))); // PHP 5.6+
        // .. for php varying arguments between action and view model.

        // $actionResult = $this->actionModel($request); // resturns ResponseMixedInterface

        // return new ResponseParameters($this->viewModel($actionResult->getViewModelParameters()), $actionResult->getResponse());

        // return $this->actionModel($request)->filter($this->viewModel);
    }
}
