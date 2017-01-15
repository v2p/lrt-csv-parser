<?php

namespace Lrt\LineProcessor;

interface LineProcessorInterface
{
    /**
     * @param $index 0-based index of current line in source file
     * @param array $line
     */
    public function processValues($index, array $line);
}