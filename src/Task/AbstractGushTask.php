<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Task;

use Bldr\Block\Core\Task\AbstractTask;
use Symfony\Component\Process\ProcessBuilder;

abstract class AbstractGushTask extends AbstractTask
{
    protected function runGit($output, $cmd)
    {
        $this->writeln($output, $this->runCommand($cmd));
    }

    protected function runCommand($cmd)
    {
        $builder = new ProcessBuilder($cmd);
        $process = $builder->getProcess();
        $process->run();

        return $process->getOutput();
    }

    protected function runGush($cmd, $symlinked = true)
    {
        $gush = ['php', 'gush.phar'];
        if ($symlinked) {
            $gush = ['gush'];
        }

        $cmd = array_merge(
            $gush,
            $cmd
        );

        return $this->runCommand($cmd);
    }

    protected function writeln($output, $content)
    {
        $output->writeln(
            [
                "<comment>------Output------</comment>",
                $content,
                "<comment>-----/Output------</comment>"
            ]
        );
    }
}
