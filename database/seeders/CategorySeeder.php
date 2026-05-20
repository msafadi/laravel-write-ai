<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Tech content',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('categories')->insert(
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Design content',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        DB::table('categories')->insert(
            [
                'name' => 'Minimalism',
                'slug' => 'minimalism',
                'description' => 'Minimal lifestyle',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
             DB::table('categories')->insert([
                'name' => 'Architecture',
                'slug' => 'architecture',
                'description' => 'Architecture content',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $design = DB::table('categories')->where('slug', 'design')->first();

        DB::table('categories')->insert([
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'parent_id' => $design->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
             DB::table('categories')->insert([
                'name' => 'Typography',
                'slug' => 'typography',
                'parent_id' => $design->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
             DB::table('categories')->insert([
                'name' => 'Color Theory',
                'slug' => 'color-theory',
                'parent_id' => $design->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
             DB::table('categories')->insert(
            [
                'name' => 'Design Systems',
                'slug' => 'design-systems',
                'parent_id' => $design->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
