<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call\PullRequest;

use Bldr\Block\Gush\Call\AbstractGushCall;

/**
 * Example:
 * -
 *     type: gush:pull-request:merge
 *     base_branch: master
 *     symlinked: true
 */
class MergeCall extends AbstractGushCall
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this
            ->setName('gush:pull-request:merge')
            ->setDescription('Runs a series of commands to merge and clean up')
            ->addOption('base_branch', false, 'Base branch to merge things into', 'master')
            ->addOption('symlinked', false, 'Run with symlinked gush', true)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $symlinked = $this->getOption('symlinked');
        $baseBranch = $this->getOption('base_branch');

        $this->writeln($this->runGush(['p:merge'], $symlinked));
        $this->writeln($this->runGush(['b:d'], $symlinked));
        $this->runGit(['git', 'checkout', $baseBranch]);
        $this->runGit(['git', 'pull', '-u', 'origin', $baseBranch]);
        $this->runGit(['git', 'branch', '-d', '-']);
    }
}
