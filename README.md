PHP7+ Git Commands
==================

Executes git commands within your PHP project.  
This project's purpose is to wrap basic git commands. We won't provide a command or an option if nobody requires it.

[![Build Status][travis-master-img]][travis-master-url] [![Coverage Status][coveralls-master-img]][coveralls-master-url] [![Scrutinizer Code Quality][scrutinizer-master-img]][scrutinizer-master-url]

[travis-master-img]: https://travis-ci.org/git-pull-request/php-semver.svg?branch=master
[travis-master-url]: https://travis-ci.org/git-pull-request/php-semver
[coveralls-master-img]: https://coveralls.io/repos/github/git-pull-request/php-semver/badge.svg?branch=master
[coveralls-master-url]: https://coveralls.io/github/git-pull-request/php-semver?branch=master
[scrutinizer-master-img]: https://scrutinizer-ci.com/g/git-pull-request/php-semver/badges/quality-score.png?b=master
[scrutinizer-master-url]: https://scrutinizer-ci.com/g/git-pull-request/php-semver/?branch=master

Installation
------------

Install the latest version with

```bash
$ composer require git-pull-request/git
```

Requirements
------------

At the time this project was created, PHP 7 was the latest stable version. So it became the de facto PHP supported
version.

We try to have as fewer dependencies as possible.  
If you can not use this project because of its library dependencies, please open an issue.

**The `git tag` commands will assume all your tags to be valid [Semantic Versioning](http://semver.org)**

Usage
-----

```php
use Git\Git\Git;

$git = new Git;
// git add file1 file2
$git->add(['file1', 'file2']);

// git branch branch-name HEAD
$git->createBranch('branch-name') : bool;
// git branch branch-name master
$git->createBranch('branch-name', 'master') : bool;
// git branch -d branch-name
$git->deleteBranch('branch-name') : bool;
// git branch -D branch-name
$git->deleteBranch('branch-name', true) : bool;
// git branch --all
$git->listAllBranches() : array;
// git branch --list
$git->listLocalBranches() : array;
// git branch --list branch*
$git->listLocalBranches('branch*') : array;
// git branch --remotes
$git->listRemoteBranches() : array;

// git checkout my-existing-branch
$git->checkout('my-existing-branch') : bool;

// git clone -q git@github.com:git-pull-request/git.git
$git->cloneRepository('git@github.com:git-pull-request/git.git') : bool;
// git clone git@github.com:git-pull-request/git.git directory
$git->cloneRepository('git@github.com:git-pull-request/git.git', 'directory', '') : bool;

// git commit -m "My commit message"
$git->commit('My commit message');

// git pull origin master
$git->pull('origin', 'master') : bool;

// git rev-parse --show-toplevel
$git->getProjectRootDir() : string;
// git rev-parse --is-inside-work-tree
$git->isInsideWorkTree() : bool;

// git tag
$git->getTags(); // ex: return [new Version(1, 0, 0), new Version(1, 1, 0)];
$git->getLastTag(); // ex: return new Version(1, 0, 0);

```
