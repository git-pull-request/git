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

use GitPullRequest\Git\GitCommand\TagTrait;
use PHPUnit_Framework_TestCase;
use SemVer\SemVer\Version;
use Symfony\Component\Process\Process;

/**
 * Test of the trait TagTrait.
 */
final class TagTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var TagTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(TagTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testCreateAnnotatedTag()
    {
        $version = new Version(1, 0, 0);
        $this->object->createAnnotatedTag($version, 'version 1.0.0');
        $process = new Process('git tag');
        $process->mustRun();

        $found  = false;
        $output = explode(PHP_EOL, $process->getOutput());
        foreach ($output as $line) {
            if (trim($line) === '1.0.0') {
                $found = true;
            }
        }

        static::assertTrue($found, 'Tag 1.0.0 must be found');
    }

    public function testGetLastTag()
    {
        static::assertEquals(new Version(0, 2, 0), $this->object->getLastTag());
    }

    public function testGetTags()
    {
        $expected = [
            new Version(0, 1, 0),
            new Version(0, 2, 0),
        ];
        static::assertEquals($expected, $this->object->getTags());
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     */
    public function testGetTagsFailsWithWrongTagFormat()
    {
        (new Process('git tag a.b.c -m "wrong tag version"'))->disableOutput()->mustRun();
        $this->object->getTags();
    }

    public function testGetTagsWithEmptyTags()
    {
        (new Process('git tag --delete 0.1.0 0.2.0;'))->disableOutput()->mustRun();
        static::assertEmpty($this->object->getTags());
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     */
    public function testGetTagsOutsideGitDirectoryFails()
    {
        chdir('..');
        $this->object->getTags();
    }
}
