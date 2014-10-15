<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Task\PullRequest;

use Bldr\Block\Gush\Task\AbstractGushTask;

/**
 * Example:
 * -
 *     type: gush:pull-request:merge
 *     base_branch: master
 *     symlinked: true
 */
class MergeTask extends AbstractGushTask
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this
            ->setName('gush:pull-request:merge')
            ->setDescription('Runs a series of commands to merge and clean up')
            ->addParameter('base_branch', false, 'Base branch to merge things into', 'master')
            ->addParameter('symlinked', false, 'Run with symlinked gush', true)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $symlinked = $this->getParameter('symlinked');
        $baseBranch = $this->getParameter('base_branch');

        $this->writeln($this->runGush(['p:merge'], $symlinked));
        $this->writeln($this->runGush(['b:d'], $symlinked));
        $this->runGit(['git', 'checkout', $baseBranch]);
        $this->runGit(['git', 'pull', '-u', 'origin', $baseBranch]);
        $this->runGit(['git', 'branch', '-d', '-']);
    }
}
