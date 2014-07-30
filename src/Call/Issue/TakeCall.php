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

/**
 * Example: 
 * -
 *   type: gush:issue:take
 *   id: $ISSUE_ID$
 *   wip: true
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
            'i:take',
            '--issue_number='.$this->getOption('id'),
        ];

        $output = $this->runCommand($cmd);

        if ($this->getOption('wip') !== false) {
            $cmd = [
                'issue:label:assign',
                '--label=WIP',
            ];
            $output .= $this->runCommand($this->gush($cmd));
        }

        $this->writeln($output);
    }
}
