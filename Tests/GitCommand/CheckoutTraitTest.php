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

use GitPullRequest\Git\GitCommand\CheckoutTrait;
use PHPUnit_Framework_TestCase;

/**
 * Test of the trait CheckoutTrait.
 */
final class CheckoutTraitTest extends PHPUnit_Framework_TestCase
{
    use GitTestTrait;
    /** @var CheckoutTrait */
    private $object;

    protected function setUp()
    {
        $this->object = $this->getObjectForTrait(CheckoutTrait::class);
        $this->prepareWorkingDirectory();
    }

    protected function tearDown()
    {
        $this->cleanWorkingDirectory();
    }

    public function testCheckout()
    {
        static::assertTrue($this->object->checkout('branch1'));
    }

    /**
     * @expectedException \GitPullRequest\Git\Exception\RuntimeException
     *
     * @throws \PHPUnit_Framework_Exception
     */
    public function testCheckoutFailsWithUnknownBranch()
    {
        $this->object->checkout('-unknown branch');
    }
}
