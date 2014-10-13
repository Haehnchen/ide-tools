<?php

namespace espend\Ide\DataCollector;

use espend\Ide\DataCollector\Collector\IdeCollectorParameter;
use espend\Ide\DataCollector\Collector\IdeDataCollectorInterface;
use espend\Ide\DataCollector\Path\RelativeProjectPathResolver;

class DataCollector
{

    /**
     * @var IdeDataCollectorInterface[]
     */
    protected $collectors = array();
    protected $pathResolver;

    public function __construct(RelativeProjectPathResolver $pathResolver)
    {
        $this->pathResolver = $pathResolver;
    }

    public function collect()
    {

        $parameter = new IdeCollectorParameter($this->pathResolver);

        $collected = array();
        foreach ($this->collectors as $collector) {
            $data = $collector->collect($parameter);

            // @TODO: merge recursive; to allow same alias more then once?
            if ($data != null && is_array($data) && count($data) > 0) {
                $collected[$collector->getAlias()] = $data;
            }
        }

        return $collected;
    }

    public function addCollector(IdeDataCollectorInterface $collector)
    {
        $this->collectors[] = $collector;
    }

}