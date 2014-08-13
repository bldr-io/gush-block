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
 *     symlinked: true
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

        $cmd = ['git', 'checkout', $baseBranch];
        $output = $this->runCommand($cmd, $symlinked);
        $this->writeln($output);

        $cmd = ['b:s'];
        $output = $this->runGush($cmd, $symlinked);
        $this->writeln($output);

        $cmd = ['git', 'checkout', '-'];
        $output = $this->runCommand($cmd, $symlinked);
        $this->writeln($output);

        $cmd = ['git', 'rebase', 'origin/'.$baseBranch];
        $output = $this->runCommand($cmd, $symlinked);
        $this->writeln($output);
    }
}
