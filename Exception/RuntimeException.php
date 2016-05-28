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

namespace GitPullRequest\Git\Exception;

use RuntimeException as BaseException;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 *
 * @link http://php.net/manual/en/class.runtimeexception.php
 */
final class RuntimeException extends BaseException implements GitExceptionInterface
{
}
