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

// No dependency in HttpF so should be moved to POInterface

class IdentityViewModel
{
    public function __invoke(...$arguments) // PHP 5.6+
    {
        return $arguments;
    }
}
