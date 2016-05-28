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

use GitPullRequest\Git\Exception\RuntimeException;
use GitPullRequest\Git\GitCommand\RevParseTrait;
use PHPUnit_Framework_TestCase;

/**
 * Test of the trait RevParseTrait.
 */
final class RevParseTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var RevParseTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(RevParseTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testGetProjectRootDir()
    {
        static::assertEquals($this->tmpDirectory, $this->object->getProjectRootDir());
        chdir('dir');
        static::assertEquals($this->tmpDirectory, $this->object->getProjectRootDir());
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     * @expectedExceptionMessage fatal: Unable to get repository root dir. Are you in the .git directory?
     */
    public function testGetProjectRootDirFailsIfInDotGitDirectory()
    {
        chdir('.git');
        $this->object->getProjectRootDir();
    }

    public function testRevParseFailsWithWrongRepository()
    {
        chdir('..');
        $exception = false;
        try {
            $this->object->getProjectRootDir();
        } catch (RuntimeException $exception) {
            $exception = true;
        }
        static::assertTrue($exception);
    }

    public function testIsInsideWorkTree()
    {
        static::assertTrue($this->object->isInsideWorkTree());
        chdir('..');
        static::assertFalse($this->object->isInsideWorkTree());
        chdir($this->tmpDirectory.DIRECTORY_SEPARATOR.'.git');
        static::assertFalse($this->object->isInsideWorkTree());
    }
}
