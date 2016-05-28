<?php

/*
 * This file is part of git-pull-request/git.
 *
 * (c) Julien Dufresne <https://github.com/git-pull-request/git>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace GitPullRequest\Git\GitCommand;

use Exception;
use GitPullRequest\Git\Exception\RuntimeException;
use Symfony\Component\Process\Process;

/**
 * Trait to run command line.
 */
trait RunCommandTrait
{
    /**
     * @param string   $commandLine
     * @param int|null $timeout
     *
     * @throws RuntimeException
     *
     * @return string
     */
    private function runCommand(string $commandLine, $timeout = 60) : string
    {
        try {
            $process = new Process($commandLine);
            $process->setTimeout($timeout);
            $process->mustRun();
            $output = $process->getOutput();
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }

        return trim($output);
    }

    /**
     * @param string   $commandLine
     * @param int|null $timeout
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    private function runCommandSilently(string $commandLine, $timeout = 60) : bool
    {
        try {
            $process = new Process($commandLine);
            $process->setTimeout($timeout);
            $process->disableOutput();
            $process->mustRun();
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }

        return $process->isSuccessful();
    }
}
