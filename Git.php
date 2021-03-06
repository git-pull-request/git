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

use GitPullRequest\Git\GitCommand\AddTrait;
use GitPullRequest\Git\GitCommand\BranchTrait;
use GitPullRequest\Git\GitCommand\CheckoutTrait;
use GitPullRequest\Git\GitCommand\CloneTrait;
use GitPullRequest\Git\GitCommand\CommitTrait;
use GitPullRequest\Git\GitCommand\ConfigTrait;
use GitPullRequest\Git\GitCommand\LogTrait;
use GitPullRequest\Git\GitCommand\MergeTrait;
use GitPullRequest\Git\GitCommand\PullTrait;
use GitPullRequest\Git\GitCommand\RevParseTrait;
use GitPullRequest\Git\GitCommand\RunCommandTrait;
use GitPullRequest\Git\GitCommand\TagTrait;

/**
 * Class containing all the available git commands.
 */
final class Git
{
    use RunCommandTrait, AddTrait, BranchTrait, CheckoutTrait, CloneTrait, CommitTrait, ConfigTrait, LogTrait, MergeTrait, PullTrait, RevParseTrait, TagTrait {
        RunCommandTrait::runCommand insteadof AddTrait, BranchTrait, CheckoutTrait, CloneTrait, CommitTrait, ConfigTrait, LogTrait, MergeTrait, PullTrait, RevParseTrait, TagTrait;
        RunCommandTrait::runCommandSilently insteadof AddTrait, BranchTrait, CheckoutTrait, CloneTrait, CommitTrait, ConfigTrait, LogTrait, MergeTrait, PullTrait, RevParseTrait, TagTrait;
    }
}
