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

use GitPullRequest\Git\GitCommand\PullTrait;
use PHPUnit_Framework_TestCase;

/**
 * Test of the trait PullTrait.
 */
final class PullTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var PullTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(PullTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testPull()
    {
        static::assertTrue($this->object->pull('file:////'.$this->tmpDirectory, 'master'));
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     */
    public function testPullFailsWithWrongRepository()
    {
        $this->object->pull('file:////unknown');
    }
}
