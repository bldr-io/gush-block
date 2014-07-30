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
 * @author Aaron Scherer <aequasi@gmail.com>
 * 
 * Example: 
 * -
 *   type: gush:issue:open
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
        $this->setName('open')
            ->setDescription('Opens the issue specified by the `id` option')
            ->addOption('id', true, 'Issue ID to Take')
            ->addOption('wip', false, 'Should the issue be tagged as WIP?', false)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $command = [
            'php',
            'gush.phar',
            'i:create',
            '--issue_number='.$this->getOption('id'),
            ''
        ];
        = ProcessBuilder::create($cmd)
        if ($this->getOption('wip') !== false) {
            $input = new ArgvInput(['--label=WIP']);

        }
    }
}
