<?php

use Illuminate\Support\Facades\Blade;
use Oblak\Vocative\Facades\Vocative;

it('can transform names using facade', function () {
    expect(Vocative::make('Милица'))->toBe('Милице');
    expect(Vocative::make('Марко'))->toBe('Марко');
    expect(Vocative::make('Никола'))->toBe('Никола');
});

it('uses dictionary entries', function () {
    expect(Vocative::make('Лука'))->toBe('Лука');
    expect(Vocative::make('Лука', true))->not->toBe('Лука');
});

it('can use custom dictionary entries from config', function () {
    // Create a custom entry in config
    config()->set('vocative.dictionary', [
        'ТЕСТ' => 'ТЕСТЕ',
    ]);

    // Refresh the instance to pick up config changes
    app()->forgetInstance('vocative');

    expect(Vocative::make('ТЕСТ'))->toBe('Тесте');
});

it('can transform names using blade directive', function () {
    $output = blade('@vocative("Милица")');
    expect($output)->toBe('Милице');

    $output = blade('@voc("Марко")');
    expect($output)->toBe('Марко');
});

// Helper function to test blade compilation
function blade(string $string, array $data = [])
{
    $string = Blade::compileString($string);

    ob_start();
    extract($data, EXTR_SKIP);
    eval('?>'.$string);
    $string = ob_get_contents();
    ob_end_clean();

    return $string;
}
