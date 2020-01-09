<?php
use App\Todo;
use Illuminate\Database\Seeder;

class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Todo=Todo::where('id','1')->first();

        if(!$Todo){
            Todo::create([
                'name' => 'toDo Test',
                'description' => 'toDo Description',
                'user_id' => '1',
                'category_id'=>'1'
            ]); 
        }
    }
}
