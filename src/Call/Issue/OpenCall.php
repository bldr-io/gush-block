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
            ->addOption('wip', false, 'Should the issue be tagged as WIP?', false);
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        /*
         * Right now, this is kinda ghetto, but if the logic of the gush
         * commands is moved to a service, this block could use the services instead
         * of running these commands.
         *
         * This wont work right now, as it wont read a .gush.yml file, but a little work in gush
         * and that piece should work...
         *
         * This MAY not even be the best way to do this... But the idea still stands..
         */

        $input = new ArgvInput(['--issue_number='.$this->getOption('id')]);

        $command = new IssueTakeCommand();
        $command->run($input, $this->getOutput());

        if ($this->getOption('wip') !== false) {
            $input = new ArgvInput(['--label=WIP']);

            $command = new LabelIssuesCommand();
            $command->run($input, $this->getOutput());
        }
    }
}
