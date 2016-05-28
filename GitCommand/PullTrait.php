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

use GitPullRequest\Git\Exception\RuntimeException;

/**
 * PHP abstraction of the <code>git pull</code> command.
 */
trait PullTrait
{
    use RunCommandTrait;

    /**
     * @param string $repository
     * @param string $refSpec
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    public function pull(string $repository, string $refSpec = '') : bool
    {
        return $this->runCommandSilently(sprintf('git pull %s %s', $repository, $refSpec), null);
    }
}
