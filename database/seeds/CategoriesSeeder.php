<?php
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=array('Food','Entertainment','Services','Events');
            
        foreach ($categories as $category){
            Category::create([
                'name' => $category
            ]);
        }

         
    }
}
