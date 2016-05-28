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

namespace GitPullRequest\Git;

use GitPullRequest\Git\GitCommand\BranchTrait;
use GitPullRequest\Git\GitCommand\CheckoutTrait;
use GitPullRequest\Git\GitCommand\TagTrait;

/**
 * Class containing all the available git commands.
 */
final class Git
{
    use BranchTrait;
    use CheckoutTrait;
    use TagTrait;
}
