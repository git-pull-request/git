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

/**
 * PHP abstraction of the <code>git branch</code> command.
 */
trait AddTrait
{
    use RunCommandTrait;

    /**
     * @param string|string[] $files
     *
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     *
     * @return bool
     */
    public function add($files = '.') : bool
    {
        $commandLine = 'git add';
        foreach ((array) $files as $file) {
            $commandLine .= sprintf(' "%s"', (string) $file);
        }

        return $this->runCommandSilently($commandLine);
    }
}
