<?php

namespace Database\Seeders;

use App\Models\MasterAttendType;
use Illuminate\Database\Seeder;

class MasterTeacherAttend extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrays = ['Absensi Masuk', 'Absensi Pulang'];
        foreach ($arrays as $item) {
            MasterAttendType::create([
                'name' => $item,
            ]);
        }
    }
}
