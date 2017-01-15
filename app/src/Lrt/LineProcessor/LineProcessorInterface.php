<?php

namespace Lrt\LineProcessor;

interface LineProcessorInterface
{
    /**
     * @param array $values
     */
    public function processValues(array $values);
}