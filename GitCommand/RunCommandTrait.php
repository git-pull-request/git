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
     * @param string $commandLine
     *
     * @throws RuntimeException
     *
     * @return string
     */
    private function runCommand(string $commandLine) : string
    {
        try {
            $process = new Process($commandLine);
            $process->mustRun();
            $output = $process->getOutput();
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }

        return trim($output);
    }

    /**
     * @param string $commandLine
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    private function runCommandSilently(string $commandLine) : bool
    {
        try {
            $process = new Process($commandLine);
            $process->disableOutput();
            $process->mustRun();
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }

        return $process->isSuccessful();
    }
}
