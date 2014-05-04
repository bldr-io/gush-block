<?php

/**
 * This file is part of frontend-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush;

use Bldr\DependencyInjection\AbstractBlock;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class GushBlock extends AbstractBlock
{
    /**
     * {@inheritDoc}
     */
    protected function assemble(array $config, SymfonyContainerBuilder $container)
    {
        $this->addCall('bldr_gush.bootstrap', 'Bldr\Block\Frontend\Call\BootstrapCall');
        $this->addCall('bldr_gush.takenassign', 'Bldr\Block\Frontend\Call\TakeAndAssignCall');
    }
}
