<?php

namespace espend\Ide\DataCollector\Collector;

interface IdeDataCollectorInterface
{
    public function collect(IdeCollectorParameter $parameter);

    public function getAlias();
}