<?php

namespace Modules\Cinema\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cinema\Entities\Cinema;
use \Carbon\Carbon;

class CinemaSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \DB::table("cinemas")->truncate();
        Cinema::insert([
            [
                'id' => 1,
                'user_id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Vascon Cinema',
                'location' => 'Lekki Jakande Ajah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
        Cinema::insert([
            [
                'id' => 2,
                'user_id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'SilverBird Cinema',
                'location' => 'Ahmodu Bello Way Victoria Ireland',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
        Cinema::insert([
            [
                'id' => 3,
                'user_id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Imax Cinema',
                'location' => 'Surulere Lagos',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
