<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call\Issue;

use Gush\Command\Issue\IssueTakeCommand;
use Gush\Command\Issue\LabelIssuesCommand;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Example: 
 * -
 *   type: gush:issue:take
 *   id: $ISSUE_ID$ # Will probably be an environment variable, as this changes a lot.
 *   wip: true
 * 
 */
class OpenCall extends AbstractIssueCall
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this->setName('take')
            ->setDescription('Takes the issue specified by the `id` option')
            ->addOption('id', true, 'Issue ID to Take')
            ->addOption('wip', false, 'Should the issue be tagged as WIP?', false)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $cmd = [
            'php',
            'gush.phar',
            'i:take',
            '--issue_number='.$this->getOption('id'),
        ];

        $this->runCommand($cmd);

        if ($this->getOption('wip') !== false) {
            [
                '--label=WIP',
            ];

        }
    }

    private function runCommand($cmd)
    {
        ProcessBuilder::create($cmd)->getProcess()->run();
    }
}
