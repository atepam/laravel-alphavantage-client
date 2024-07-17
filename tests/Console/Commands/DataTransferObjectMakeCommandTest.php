<?php

declare(strict_types=1);

use Atepam\AlphavantageClient\Console\Commands\DataTransferObjectMakeCommand;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\assertTrue;

it('can run the command successfully', function () {
    $this->artisan(DataTransferObjectMakeCommand::class, ['name' => 'Test'])
        ->assertSuccessful();
});


it('create the DTO file when called', function (string $class) {
    $file = app_path("DataObjects/$class.php");
    deleteFileIfExists($file);

    $this->assertFileDoesNotExist($file);

    $this->artisan(DataTransferObjectMakeCommand::class, ['name' => $class], )
        ->assertSuccessful();

    assertTrue(File::exists(path: app_path("DataObjects/$class.php")));
})->with('classes');


dataset('classes', function () {
    return ['aaaa', 'bbbb'];
});


