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

use GitPullRequest\Git\GitCommand\BranchTrait;
use PHPUnit_Framework_TestCase;

/**
 * Test of the trait BranchTrait.
 */
final class BranchTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var BranchTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(BranchTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testCreateBranch()
    {
        static::assertTrue($this->object->createBranch('mynewbranch'));
    }

    /** @expectedException \GitPullRequest\Git\Exception\RuntimeException */
    public function testCreateBranchFailsWithWrongBranchName()
    {
        $this->object->createBranch('my newbranch');
    }

    public function testDeleteBranch()
    {
        static::assertTrue($this->object->deleteBranch('branch2'));
    }

    /** @expectedException \GitPullRequest\Git\Exception\RuntimeException */
    public function testDeleteBranchFailsWithUnknownBranchName()
    {
        $this->object->deleteBranch('my newbranch');
    }

    public function testListAllBranches()
    {
        $result   = $this->object->listAllBranches();
        $expected = ['branch1', 'branch2', 'master'];
        static::assertEquals($expected, $result);
    }

    public function testListLocalBranchesWithPattern()
    {
        $result   = $this->object->listLocalBranches('branch*');
        $expected = ['branch1', 'branch2'];
        static::assertEquals($expected, $result);
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     */
    public function testListLocalBranchesFailsWithPattern()
    {
        $this->object->listLocalBranches('--unknown-option');
    }

    public function testListLocalBranches()
    {
        $result   = $this->object->listLocalBranches();
        $expected = ['branch1', 'branch2', 'master'];
        static::assertEquals($expected, $result);
    }

    public function testListRemoteBranches()
    {
        $result = $this->object->listRemoteBranches();
        static::assertEmpty($result);
    }
}
