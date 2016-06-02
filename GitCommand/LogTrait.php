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
 * PHP abstraction of the <code>git log</code> command.
 */
trait LogTrait
{
    use RunCommandTrait;

    /**
     * @param string $options
     *
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     *
     * @return string
     */
    public function showLog(string $options = '') : string
    {
        return $this->runCommand('git log '.$options);
    }
}
