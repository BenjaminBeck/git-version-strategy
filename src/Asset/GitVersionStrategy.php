<?php

namespace Emilep\GitVersionStrategyBundle\Asset;

use Symfony\Component\Asset\VersionStrategy\VersionStrategyInterface;

class GitVersionStrategy implements VersionStrategyInterface
{
    protected $format;
    protected $commitHash;

    public function __construct($format)
    {
        $this->format = $format;
        $this->commitHash = $this->getCommitHash();
    }

    public function getVersion($path = null)
    {
        return $this->commitHash;
    }

    public function applyVersion($path)
    {
        $version = $this->getVersion();

        if (!$version) {
            return $path;
        }

        return sprintf($this->format, $path, $version);
    }

    protected function getCommitHash()
    {
        return trim(`git rev-parse --short HEAD`);
    }
}
