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

use GitPullRequest\Git\GitCommand\AddTrait;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Test of the trait AddTrait.
 */
final class AddTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var AddTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(AddTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testAdd()
    {
        $fs = new Filesystem();
        for ($i = 1; $i < 10; ++$i) {
            $fs->dumpFile('add-file-'.$i, 'test add file');
        }
        static::assertTrue($this->object->add('add-file-1'));
        static::assertTrue($this->object->add(['add-file-2', 'add-file-3']));
    }
}
