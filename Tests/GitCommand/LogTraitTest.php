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

use GitPullRequest\Git\GitCommand\LogTrait;
use PHPUnit_Framework_TestCase;

/**
 * Test of the trait LogTrait.
 */
final class LogTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var LogTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(LogTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testShowLog()
    {
        static::assertContains('adds dir/file', $this->object->showLog('--oneline -1 --pretty=format:"%s"'));
    }
}
