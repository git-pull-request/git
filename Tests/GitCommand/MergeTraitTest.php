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
use GitPullRequest\Git\GitCommand\MergeTrait;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Test of the trait MergeTrait.
 */
final class MergeTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var MergeTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(MergeTrait::class);
        $this->prepareWorkingDirectory();
        (new Process('git checkout master'))->disableOutput()->mustRun();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testMerge()
    {
        static::assertTrue($this->object->merge('branch1'));
    }

    public function testMergeAbort()
    {
        (new Filesystem())->dumpFile('dir/file', 'If I change this content, there will be a conflict');
        (new Process('git add dir/file; git commit -m "message"'))->disableOutput()->mustRun();

        try {
            $this->object->merge('branch1');
            static::assertFalse(true);
        } catch (RuntimeException $exception) {
        }
        static::assertTrue($this->object->abortMerge());
    }
}
