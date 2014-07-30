<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush;

use Bldr\DependencyInjection\AbstractBlock;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class GushBlock extends AbstractBlock
{
    /**
     * {@inheritDoc}
     */
    protected function assemble(array $config, ContainerBuilder $container)
    {
        $this->addCall('bldr_gush.issue.open', 'Bldr\Block\Gush\Call\Issue\OpenCall', []);
    }
}