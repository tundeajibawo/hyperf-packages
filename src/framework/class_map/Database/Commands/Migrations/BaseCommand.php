<?php

declare(strict_types=1);

namespace Hyperf\Database\Commands\Migrations;

use Hyperf\Collection\Collection;
use Hyperf\Command\Command;

abstract class BaseCommand extends Command
{
    /**
     * Get all the migration paths.
     */
    protected function getMigrationPaths(): array
    {
        // Here, we will check to see if a path option has been defined. If it has we will
        // use the path relative to the root of the installation folder so our database
        // migrations may be run for any customized path from within the application.
        if ($this->input->hasOption('path') && $this->input->getOption('path')) {
            return Collection::make($this->input->getOption('path'))->map(function ($path) {
                return ! $this->usingRealPath()
                                ? BASE_PATH . DIRECTORY_SEPARATOR . $path
                                : $path;
            })->all();
        }

        return array_merge(
            $this->migrator->paths(),
            [$this->getMigrationPath()]
        );
    }

    /**
     * Determine if the given path(s) are pre-resolved "real" paths.
     *
     * @return bool
     */
    protected function usingRealPath()
    {
        return $this->input->hasOption('realpath') && $this->input->getOption('realpath');
    }

    /**
     * Get the path to the migration directory.
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        return BASE_PATH . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';
    }
}
