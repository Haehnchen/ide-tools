<?php

namespace espend\Ide\DataCollector\Path;

abstract class AbstractRelativePathResolver implements RelativeProjectPathResolver
{

    public function getPaths(array $paths)
    {

        $relativePaths = array();
        foreach ($paths as $path) {
            if ($pathRelative = $this->getPath($path)) {
                $relativePaths[] = $pathRelative;
            }
        }

        return $relativePaths;

    }

}