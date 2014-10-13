<?php

namespace espend\Ide\DataCollector\Collector;

use espend\Ide\DataCollector\Path\RelativeProjectPathResolver;

class IdeCollectorParameter
{

    protected $pathResolver;

    public function __construct(RelativeProjectPathResolver $pathResolver)
    {
        $this->pathResolver = $pathResolver;
    }

    public function getPathResolver()
    {
        return $this->pathResolver;
    }

}