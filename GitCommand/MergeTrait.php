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
 * PHP abstraction of the <code>git merge</code> command.
 */
trait MergeTrait
{
    use RunCommandTrait;

    /**
     * @param string|string[] $commit
     * @param string[]        $options
     *
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     *
     * @return bool
     */
    public function merge($commit, array $options = []) : bool
    {
        $commandLine = sprintf('git merge %s %s', implode(' ', $options), implode(' ', (array) $commit));

        return $this->runCommandSilently($commandLine);
    }

    /**
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     *
     * @return bool
     */
    public function abortMerge()
    {
        return $this->runCommandSilently('git merge --abort');
    }
}
