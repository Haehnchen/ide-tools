<?php

namespace espend\Ide\DataCollector\Path;

interface RelativeProjectPathResolver
{
    public function getPath($path);

    public function getPaths(array $paths);

    public function getRootDir();
}