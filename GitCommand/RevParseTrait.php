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

/**
 * PHP abstraction of the <code>git rev-parse</code> command.
 */
trait RevParseTrait
{
    use RunCommandTrait;

    /**
     * @throws RuntimeException
     *
     * @return string
     */
    public function getProjectRootDir() : string
    {
        $output = $this->runCommand('git rev-parse --show-toplevel');
        if ('' === $output) {
            throw new RuntimeException('fatal: Unable to get repository root dir. Are you in the .git directory?');
        }

        return $output;
    }

    /** @return bool */
    public function isInsideWorkTree() : bool
    {
        try {
            $output = $this->runCommand('git rev-parse --is-inside-work-tree');
        } catch (Exception $exception) {
            return false;
        }

        return 'true' === $output;
    }
}
