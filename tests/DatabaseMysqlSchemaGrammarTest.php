<?php

namespace I3bepb\DropForeignIfExist\Tests;

use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Mockery;
use Orchestra\Testbench\TestCase;
use RuntimeException;

class DatabaseMysqlSchemaGrammarTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'I3bepb\DropForeignIfExist\ServiceProvider',
        ];
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Get the database connection.
     *
     * @param  string|null  $connection
     * @param  string|null  $table
     * @return \Illuminate\Database\Connection
     */
    protected function getConnection($connection = null, $table = null)
    {
        return Mockery::mock(Connection::class);
    }

    public function getGrammar()
    {
        return new MySqlGrammar;
    }

    /**
     * @test
     */
    public function drop_foreign_if_exists()
    {
        $this->expectException(RuntimeException::class);
        $blueprint = new Blueprint('users');
        $blueprint->dropForeignIfExists(['order_id']);
        $blueprint->toSql($this->getConnection(), $this->getGrammar());
    }
}