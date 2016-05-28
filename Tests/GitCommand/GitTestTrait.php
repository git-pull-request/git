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

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Class.
 */
trait GitTestTrait
{
    /** @var string */
    private $currentDirectory;
    /** @var string */
    private $tmpDirectory;

    private function prepareWorkingDirectory()
    {
        $this->currentDirectory = getcwd();
        // create a tmp directory
        $tmpFile = tempnam(sys_get_temp_dir(), '');
        $fs      = new Filesystem();
        if ($fs->exists($tmpFile)) {
            $fs->remove($tmpFile);
        }

        $fs->mkdir($tmpFile);

        chdir($tmpFile);
        $this->tmpDirectory = $tmpFile;

        $fs->mkdir('dir');
        $fs->dumpFile('file', 'This is a test file');
        $fs->dumpFile('dir/file', 'This is a test file in a directory');
        $commandLine = <<<'EOF'
git init;
git config user.email "you@example.com"
git config user.name "Your Name"
git add file;
git commit -m "adds file";
git tag 0.1.0 -m "Adds file";
git branch branch1;
git add dir/file;
git commit -m "adds dir/file";
git tag 0.2.0 -m "Adds file";
git branch branch2
EOF;

        (new Process($commandLine))->mustRun();
    }

    private function cleanWorkingDirectory()
    {
        chdir($this->currentDirectory);
        $fs = new Filesystem();
        if ($fs->exists($this->tmpDirectory)) {
            $fs->remove($this->tmpDirectory);
        }
        $this->tmpDirectory     = null;
        $this->currentDirectory = null;
    }
}
