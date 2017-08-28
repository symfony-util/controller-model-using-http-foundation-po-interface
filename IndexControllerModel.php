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

class IndexControllerModel // implements interface in SU//HttpF
{
    protected $actionModel; // interface in SU//HttpF + POI(return type (php 7 -> s4 + php 7.1)
    protected $viewModel; // interface in POI

    public function __construct(ActionModelInterface $actionModel, ViewModelInterface $viewModel)
    {
        $this->actionModel = $actionModel;
        $this->viewModel = $viewModel;
    }

    public function index(Request $request)
    {
        return $this->viewModel->index($this->actionModel->index($request));
    }
}
