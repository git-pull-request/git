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
 * PHP abstraction of the <code>git checkout</code> command.
 */
trait CheckoutTrait
{
    use RunCommandTrait;

    /**
     * @param string $branchName
     *
     * @throws RuntimeException
     *
     * @return bool
     */
    public function checkout(string $branchName) : bool
    {
        return $this->runCommandSilently(sprintf('git checkout %s', $branchName));
    }
}
