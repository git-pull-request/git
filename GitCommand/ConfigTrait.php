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
 * PHP abstraction of the <code>git config</code> command.
 */
trait ConfigTrait
{
    use RunCommandTrait;

    /**
     * @param string $email
     *
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     *
     * @return bool
     */
    public function setUserEmail(string $email) : bool
    {
        return $this->runCommandSilently(sprintf('git config user.email "%s"', $email));
    }

    /**
     * @param string $name
     *
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     *
     * @return bool
     */
    public function setUserName(string $name) : bool
    {
        return $this->runCommandSilently(sprintf('git config user.name "%s"', $name));
    }
}
