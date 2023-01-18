<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Memo::class, static function (Faker\Generator $faker) {
    return [
        'odependency_id' => $faker->randomNumber(5),
        'number_memo' => $faker->sentence,
        'ref' => $faker->sentence,
        'obs' => $faker->sentence,
        'date_doc' => $faker->date(),
        'date_entry' => $faker->dateTime,
        'date_exit' => $faker->dateTime,
        'ddependency_id' => $faker->randomNumber(5),
        'admin_user_id' => $faker->randomNumber(5),
        'state_id' => $faker->randomNumber(5),
        'type_id' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Dependency::class, static function (Faker\Generator $faker) {
    return [
        'code' => $faker->randomNumber(5),
        'name' => $faker->firstName,
        'ncl' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\State::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\DocType::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\UserCedula::class, static function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber(5),
        'cedula' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\DetailMemo::class, static function (Faker\Generator $faker) {
    return [
        'memo_id' => $faker->randomNumber(5),
        'odependency_id' => $faker->randomNumber(5),
        'ddependency_id' => $faker->randomNumber(5),
        'date_entry' => $faker->dateTime,
        'date_exit' => $faker->dateTime,
        'obs' => $faker->sentence,
        'state_id' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Medium::class, static function (Faker\Generator $faker) {
    return [
        'model_type' => $faker->sentence,
        'model_id' => $faker->sentence,
        'uuid' => $faker->sentence,
        'collection_name' => $faker->sentence,
        'name' => $faker->firstName,
        'file_name' => $faker->sentence,
        'mime_type' => $faker->sentence,
        'disk' => $faker->sentence,
        'conversions_disk' => $faker->sentence,
        'size' => $faker->sentence,
        'order_column' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        'manipulations' => ['en' => $faker->sentence],
        'custom_properties' => ['en' => $faker->sentence],
        'generated_conversions' => ['en' => $faker->sentence],
        'responsive_images' => ['en' => $faker->sentence],
        
    ];
});
