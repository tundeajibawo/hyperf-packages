<?php

declare(strict_types=1);

namespace SwooleTW\Hyperf\Tests\Database;

use SwooleTW\Hyperf\Database\Query\Processors\SQLiteProcessor;
use SwooleTW\Hyperf\Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class DatabaseSQLiteProcessorTest extends TestCase
{
    public function testProcessColumnListing()
    {
        $processor = new SQLiteProcessor();

        $listing = [['name' => 'id'], ['name' => 'name'], ['name' => 'email']];
        $expected = ['id', 'name', 'email'];

        $this->assertEquals($expected, $processor->processColumnListing($listing));

        // convert listing to objects to simulate PDO::FETCH_CLASS
        foreach ($listing as &$row) {
            $row = (object) $row;
        }

        $this->assertEquals($expected, $processor->processColumnListing($listing));
    }
}
