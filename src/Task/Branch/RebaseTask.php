<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Task\Branch;

use Bldr\Block\Gush\Task\AbstractGushTask;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Example:
 * -
 *     type: gush:branch:rebase
 *     base_branch: master
 */
class RebaseTask extends AbstractGushTask
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this
            ->setName('gush:branch:rebase')
            ->setDescription('Pulls base branch and re-bases current branch off of that')
            ->addParameter('base_branch', false, 'Base branch to sync', 'master')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run(OutputInterface $output)
    {
        $baseBranch = $this->getParameter('base_branch');

        $this->runGit($output, ['git', 'checkout', $baseBranch]);
        $this->runGit($output, ['git', 'pull', '-u', 'origin', $baseBranch]);
        $this->runGit($output, ['git', 'checkout', '-']);
        $this->runGit($output, ['git', 'rebase', 'origin/'.$baseBranch]);
    }
}
