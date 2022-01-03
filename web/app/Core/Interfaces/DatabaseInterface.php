<?php
namespace App\Core\Interfaces;
interface DatabaseInterface
{

    public function createMigrationsTable(): void;

    public function applyMigrations(): void;

    public function getAppliedMigrations(): array;

    public function saveMigrations(array $newMigrations): void;
}