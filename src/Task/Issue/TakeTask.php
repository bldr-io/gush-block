<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Task\Issue;

use Bldr\Block\Gush\Task\AbstractGushTask;

/**
 * Example: 
 * -
 *     type: gush:issue:take
 *     id: $ISSUE_ID$
 *     wip: true
 */
class TakeTask extends AbstractGushTask
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this
            ->setName('gush:issue:take')
            ->setDescription('Takes the issue specified by the `id` option')
            ->addOption('id', true, 'Issue ID to Take')
            ->addOption('wip', false, 'Should the issue be tagged as WIP?', true)
            ->addOption('symlinked', false, 'Run with symlinked gush', true)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $symlinked = $this->getOption('symlinked');

        $cmd = [
            'i:take',
            '--issue_number='.$this->getOption('id'),
        ];

        $output = $this->runGush($cmd, $symlinked);

        if ($this->getOption('wip') !== false) {
            $cmd = [
                'issue:label:assign',
                '--label=WIP',
            ];
            $output .= $this->runGush($cmd, $symlinked);
        }

        $this->writeln($output);
    }
}
