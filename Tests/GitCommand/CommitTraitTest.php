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

namespace GitPullRequest\Git\Tests\GitCommand;

use GitPullRequest\Git\GitCommand\CommitTrait;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Test of the trait CommitTrait.
 */
final class CommitTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var CommitTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(CommitTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testCommit()
    {
        $fs = new Filesystem();
        for ($i = 1; $i < 10; ++$i) {
            $fs->dumpFile('commit-file-'.$i, 'test commit file');
        }

        $process = new Process('git add commit-file-1');
        $process->disableOutput();
        $process->mustRun();
        static::assertTrue($this->object->commit('Commit file name commit-file-1'));
    }
}
