<?php

/**
 * This file is part of gush-block
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Bldr\Block\Gush\Call;

use Bldr\Call\AbstractCall;
use Symfony\Component\Process\ProcessBuilder;

abstract class AbstractGushCall extends AbstractCall
{
    protected function runCommand($cmd, $cwd)
    {
        $builder = new ProcessBuilder($cmd);
        $builder->setWorkingDirectory($cwd);
        $process = $builder->getProcess();
        $process->run();

        return $process->getOutput();
    }

    protected function runGush($cmd, $cwd)
    {
        $cmd = array_merge(
            [
                'php',
                'gush.phar',
            ],
            $cmd
        );

        return $this->runCommand($cmd, $cwd);
    }

    protected function writeln($output)
    {
        $this->getOutput()->writeln(
            [
                "<comment>------Gush------</comment>",
                $output,
                "<comment>-----/Gush------</comment>"
            ]
        );
    }
}
 