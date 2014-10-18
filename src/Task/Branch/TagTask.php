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
use Herrera\Version\Dumper;
use Herrera\Version\Parser;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Example:
 * -
 *     type: gush:branch:tag
 *     base_branch: master
 */
class TagTask extends AbstractGushTask
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        $this
            ->setName('gush:branch:tag')
            ->setDescription('Tags automatically a release')
            ->addParameter('base_branch', false, 'Base branch to tag', 'master')
            ->addParameter('release', false, 'type of release patch, minor or major')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function run(OutputInterface $output)
    {
        $baseBranch = $this->getParameter('base_branch');
        $release = $this->getParameter('release');

        $this->runGit($output, ['git', 'checkout', $baseBranch]);
        $lastTag = $this->runCommand(['git', 'describe', '--tags', '--abbrev=0', 'HEAD']);

        $builder = Parser::toBuilder($lastTag);

        switch (true) {
            case 'major' === $release:
                $builder->incrementMajor();
                break;
            case 'minor' === $release:
                $builder->incrementMinor();
                break;
            case 'patch' === $release:
                $builder->incrementPatch();
                break;
            default:
                $builder->incrementPatch();
                break;
        }

        $newNumber = Dumper::toString($builder->getVersion());

        $this->runGit($output, ['git', 'tag', '-a', $newNumber, '-m', 'auto tagged']);
        $this->runGit($output, ['git', 'push', '--tags']);
    }
}
