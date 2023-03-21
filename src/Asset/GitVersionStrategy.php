<?php

namespace Emileperron\GitVersionStrategyBundle\Asset;

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

    public function getVersion(string $path = null): string
    {
        return $this->commitHash;
    }

    public function applyVersion(string $path): string
    {
        $version = $this->getVersion();

        if (!$version) {
            return $path;
        }

        return sprintf($this->format, $path, $version);
    }

    protected function getCommitHash(): string
    {
        return trim(`git rev-parse --short HEAD`);
    }
}
