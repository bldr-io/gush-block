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
class TakeAndAssignCall extends AbstractCall
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('takenassign')
            ->setDescription('This takes and assign a ticket')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {

    }
}
