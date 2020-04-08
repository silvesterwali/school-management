<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Menus;
use Faker\Generator as Faker;

$factory->define(Menus::class, function (Faker $faker) {
    return [
        'name'      => $faker->sentence(4, true),
        'href'      => '/href',
        'icon'      => null,
        'slug'      => 'link',
        'parent_id' => null,
        'menu_id'   => 1,
        'sequence'  => 1,
    ];
});
