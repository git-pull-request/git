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

namespace GitPullRequest\Git\GitCommand;

use Exception;
use GitPullRequest\Git\Exception\RuntimeException;
use SemVer\SemVer\Version;
use SemVer\SemVer\VersionSorter;
use Symfony\Component\Process\Process;

/**
 * PHP abstraction of the <code>git tag</code> command.
 */
trait TagTrait
{
    use RunCommandTrait;

    /**
     * @param Version $tag
     * @param string  $message
     *
     * @throws \GitPullRequest\Git\Exception\RuntimeException
     */
    public function createAnnotatedTag(Version $tag, string $message)
    {
        $this->runCommandSilently(sprintf('git tag -a %s -m "%s"', (string)$tag, $message));
    }

    /**
     * @throws RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return Version|null
     */
    public function getLastTag()
    {
        $versionsSorted = VersionSorter::sort($this->getTags());
        $last           = end($versionsSorted);

        return false === $last ? null : $last;
    }

    /**
     * @throws RuntimeException
     *
     * @return Version[]
     */
    public function getTags()
    {
        try {
            $output = $this->runCommand('git tag');
            $tagList = explode(PHP_EOL, trim($output));
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage(), 0, $exception);
        }

        $tagList = array_filter($tagList);

        if (0 === count($tagList)) {
            return $tagList;
        }
        $versions = [];
        foreach ($tagList as $tag) {
            try {
                $versions[] = Version::fromString($tag);
            } catch (Exception $exception) {
                throw new RuntimeException($exception->getMessage(), 0, $exception);
            }
        }

        return $versions;
    }
}
