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
 * PHP abstraction of the <code>git clone</code> command.
 */
trait CloneTrait
{
    use RunCommandTrait;

    /**
     * @param string $repositoryURL
     * @param string $destination
     * @param string $options
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    public function cloneRepository(string $repositoryURL, string $destination = '', string $options = '-q') : bool
    {
        return $this->runCommandSilently(sprintf('git clone %s %s %s', $options, $repositoryURL, $destination), null);
    }
}
