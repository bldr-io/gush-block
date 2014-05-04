<?php

/**
 * This file is part of frontend-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call;

use Bldr\Call\AbstractCall;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class BootstrapCall extends AbstractCall
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('bootstrap')
            ->setDescription('This creates and takes an issue')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {

    }
}
