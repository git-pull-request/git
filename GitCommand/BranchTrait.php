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
 * PHP abstraction of the <code>git branch</code> command.
 */
trait BranchTrait
{
    use RunCommandTrait;

    /**
     * @param string $branchName
     * @param string $startingPoint
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    public function createBranch(string $branchName, string $startingPoint = 'HEAD') : bool
    {
        return $this->runCommandSilently(sprintf('git branch "%s" "%s"', $branchName, $startingPoint));
    }

    /**
     * @param string $branchName
     * @param bool   $hardDelete
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    public function deleteBranch(string $branchName, bool $hardDelete = false) : bool
    {
        return $this->runCommandSilently(sprintf('git branch %s %s', $hardDelete ? '-D' : '--delete', $branchName));
    }

    /**
     * @throws RuntimeException
     *
     * @return array
     */
    public function listAllBranches() : array
    {
        return $this->listBranches('--all');
    }

    /**
     * @param string $pattern
     *
     * @throws RuntimeException
     *
     * @return array
     */
    public function listLocalBranches(string $pattern = '') : array
    {
        return $this->listBranches('--list', $pattern);
    }

    /**
     * @throws RuntimeException
     *
     * @return array
     */
    public function listRemoteBranches() : array
    {
        return $this->listBranches('--remotes');
    }

    /**
     * @param string $option
     * @param string $pattern
     *
     * @throws RuntimeException
     *
     * @return string[]
     */
    private function listBranches(string $option, string $pattern = '') : array
    {
        $output = $this->runCommand(sprintf('git branch --no-column --no-color %s %s', $option, $pattern));

        $branches = explode(PHP_EOL, $output);
        $result   = [];
        foreach ($branches as $branch) {
            $branch = trim($branch);
            if ('' === $branch) {
                continue;
            }
            $result[] = '*' === $branch[0] ? substr($branch, 2) : trim($branch);
        }

        return $result;
    }
}
