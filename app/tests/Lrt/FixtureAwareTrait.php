<?php

namespace Lrt;

trait FixtureAwareTrait
{
    /**
     * @param string $fileName
     * @return string
     */
    protected function getFullPathToFixture($fileName)
    {
        return TESTS_DIR . '/' . str_replace('\\', '/', __CLASS__) . '/fixtures/' . $fileName;
    }
}