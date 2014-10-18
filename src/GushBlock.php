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

class GushBlock extends AbstractBlock
{
    /**
     * {@inheritDoc}
     */
    protected function assemble(array $config, ContainerBuilder $container)
    {
        $this->addTask('bldr_gush.issue.take', 'Bldr\Block\Gush\Task\Issue\TakeTask');
        $this->addTask('bldr_gush.issue.create', 'Bldr\Block\Gush\Task\Issue\CreateTask');
        $this->addTask('bldr_gush.pull_request.take', 'Bldr\Block\Gush\Task\PullRequest\MergeTask');
        $this->addTask('bldr_gush.branch.rebase', 'Bldr\Block\Gush\Task\Branch\RebaseTask');
        $this->addTask('bldr_gush.branch.tag', 'Bldr\Block\Gush\Task\Branch\TagTask');
    }
}
