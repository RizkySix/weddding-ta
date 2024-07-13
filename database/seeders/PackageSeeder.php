<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Decoration;
use App\Models\Package;
use App\Models\Price;
use App\Trait\HelperTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    use HelperTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrDecorationId = [];
        //create decoration
        for ($i = 1; $i <= 6; $i++) {
            $decor = Decoration::create([
                'uuid' => $this->setUuid(),
                'name' => 'Decoration tipe ' . $i,
                'detail' => fake()->text(100),
                'created_by' => 'Admin'
            ]);

            $arrDecorationId[] = $decor->id;
        }

        $arrPackageInstace = [];
        //create package
        for ($k = 1; $k <= 3; $k++) {
            $package = Package::create([
                'uuid' => $this->setUuid(),
                'name' => 'Paket tipe ' . $k,
                'stock' => rand(5, 11),
                'created_by' => 'Admin'
            ]);

            //create catalog
            for($z= 1; $z<=3; $z++) {
                Catalog::create([
                    'uuid' => $this->setUuid(),
                    'package_id' => $package->id,
                    'path' => 'tmp/wed' . $z . '.jpg',
                    'order' => $i
                ]);
            }

            //create price
            Price::create([
                'uuid' => $this->setUuid(),
                'package_id' => $package->id,
                'price' => rand(500000, 1000000),
                'discount' => rand(10, 50),
                'created_by' => 'Admin'
            ]);

            $arrPackageInstace[] = $package;
        }

        foreach ($arrPackageInstace as $pack) {
            shuffle($arrDecorationId);

            // Slice the array to get a random number of elements (between 3 and 4)
            $slicedArray = array_slice($arrDecorationId, 0, rand(3, 4));

            // Attach the decorations to the package
            $pack->decoration()->attach($slicedArray, ['added_at' => now()]);
        }
    }
}
