<?php

namespace espend\Ide\DataCollector\Path\Symfony;

use espend\Ide\DataCollector\Path\AbstractRelativePathResolver;
use Symfony\Component\Filesystem\Filesystem;

class FilesystemResolver extends AbstractRelativePathResolver
{

    protected $filesystem;
    protected $rootDir;

    public function __construct(Filesystem $filesystem, $rootDir)
    {
        $this->filesystem = $filesystem;
        $this->rootDir = realpath($rootDir);
    }

    public function getPath($path)
    {
        return $this->filesystem->makePathRelative($path, $this->getRootDir());
    }

    public function getRootDir()
    {
        return $this->rootDir;
    }
}