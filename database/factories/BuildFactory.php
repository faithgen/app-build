<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faithgen\AppBuild\Models\Build;
use Faithgen\AppBuild\Models\BuildLog;
use Faithgen\AppBuild\Models\BuildRequest;
use Faithgen\AppBuild\Models\MinistryModule;
use Faithgen\AppBuild\Models\Module;
use Faithgen\AppBuild\Models\Template;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Build::class, function (Faker $faker) {
    return [
        'id'      => Str::uuid()->toString(),
        'version' => '1.'.rand(0, 99),
        'status'  => Build::BUILD_STATUS[rand(0, 2)],
    ];
});

$factory->define(BuildLog::class, function (Faker $faker) {
    return [
        'id'      => Str::uuid()->toString(),
        'task'    => $faker->sentence(3),
        'result'  => $faker->sentence,
        'success' => true,
    ];
});

$factory->define(BuildRequest::class, function (Faker $faker) {
    return [
        'id'         => Str::uuid()->toString(),
        'release'    => [true, false][rand(0, 1)],
        'processing' => [true, false][rand(0, 1)],
        'processed'  => [true, false][rand(0, 1)],
    ];
});

$factory->define(MinistryModule::class, function () {
    return [
        'id'     => Str::uuid()->toString(),
        'active' => true,
    ];
});

$factory->define(Module::class, function (Faker $faker) {
    return [
        'id'             => Str::uuid()->toString(),
        'name'           => $faker->company,
        'repository'     => 'https://github.com/innoflash/'.$faker->word,
        'implementation' => 'https://github.com/innoflash/'.$faker->word,
        'module_class'   => 'app.innoflash.classname.'.$faker->word,
        'description'    => $faker->sentence(75),
        'active'         => true,
    ];
});

$factory->define(Template::class, function (Faker $faker) {
    return [
        'id'          => Str::uuid()->toString(),
        'name'        => $faker->name,
        'repository'  => 'https://github.com/templates/'.$faker->word,
        'branch'      => $faker->word,
        'description' => $faker->sentence(75),
        'active'      => true,
    ];
});
