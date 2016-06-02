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

use GitPullRequest\Git\GitCommand\ConfigTrait;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Process\Process;

/**
 * Test of the trait ConfigTrait.
 */
final class ConfigTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var ConfigTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(ConfigTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testSetUserEmail()
    {
        $name = 'github@dfrsn.me';
        static::assertTrue($this->object->setUserEmail($name));

        $output = explode(PHP_EOL, (new Process('git config --list'))->mustRun()->getOutput());
        $found  = false;
        foreach ($output as $line) {
            $line = trim($line);
            if ($line === 'user.email='.$name) {
                $found = true;
                break;
            }
        }
        static::assertTrue($found, 'user.email should be set');
    }

    public function testSetUserName()
    {
        $name = 'Julien Dufresne';
        static::assertTrue($this->object->setUserName($name));

        $output = explode(PHP_EOL, (new Process('git config --list'))->mustRun()->getOutput());
        $found  = false;
        foreach ($output as $line) {
            $line = trim($line);
            if ($line === 'user.name='.$name) {
                $found = true;
                break;
            }
        }
        static::assertTrue($found, 'user.name should be set');
    }
}
