<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call\Branch;

use Bldr\Block\Gush\Call\AbstractGushCall;

/**
 * Example:
 * -
 *     type: gush:branch:rebase
 *     base_branch: master
 */
class RebaseCall extends AbstractGushCall
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this
            ->setName('gush:branch:rebase')
            ->setDescription('Pulls base branch and re-bases current branch off of that')
            ->addOption('base_branch', false, 'Base branch to sync', 'master')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $baseBranch = $this->getOption('base_branch');

        $this->runGit(['git', 'checkout', $baseBranch]);
        $this->runGit(['git', 'pull', '-u', 'origin', $baseBranch]);
        $this->runGit(['git', 'checkout', '-']);
        $this->runGit(['git', 'rebase', 'origin/'.$baseBranch]);
    }
}
