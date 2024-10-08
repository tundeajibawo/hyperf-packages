<?php

declare(strict_types=1);

namespace SwooleTW\Hyperf\Foundation\Testing;

class RefreshDatabaseState
{
    /**
     * Indicates if the test database has been migrated.
     *
     * @var bool
     */
    public static $migrated = false;

    /**
     * Indicates if a lazy refresh hook has been invoked.
     *
     * @var bool
     */
    public static $lazilyRefreshed = false;
}
