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

use GitPullRequest\Git\GitCommand\CloneTrait;
use PHPUnit_Framework_TestCase;

/**
 * Test of the trait CloneTrait.
 */
final class CloneTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var CloneTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(CloneTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testCloneRepository()
    {
        static::assertTrue($this->object->cloneRepository('file:////'.$this->tmpDirectory));
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     */
    public function testCloneRepositoryFailsWithWrongRepository()
    {
        $this->object->cloneRepository('file:////unknown');
    }
}
