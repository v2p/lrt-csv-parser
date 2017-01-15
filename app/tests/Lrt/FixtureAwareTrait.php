<?php

namespace Lrt;

trait FixtureAwareTrait
{
    /**
     * Generate full path to fixture file / directory which belongs to concrete test case
     *
     * @param string $fileOrDirectoryName
     * @return string
     */
    protected function getFullPathToFixture($fileOrDirectoryName)
    {
        return TESTS_DIR . '/' . str_replace('\\', '/', __CLASS__) . '/fixtures/' . $fileOrDirectoryName;
    }
}