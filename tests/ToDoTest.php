<?php

class ToDoTest extends TestCase
{

     /**
     * /todos [GET]
     */
    public function testShouldReturnAllToDos(){
        
        $this->get("todo", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'name',
                    'description',
                    'status',    
                    'category_id',    
                    'user_id',     
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ],
            'meta' => [
                '*' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);
        
    }

    public function a_user_can_create_a_todo(){

        $attributes=[
             'name'=>'Test',
             'description'=>'Test Description',
             'status'=> 'Overdue',
             'category_id'=>'1',
             'user_id'=>'1'
        ];
 
        $this->post("todo/create", $attributes, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'name',
                    'description',
                    'status',
                    'updatcategory_ided_at',
                    'user_id'
                ]
            ]    
        );

    }
}

?>