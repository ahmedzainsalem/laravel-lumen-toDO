<?php
namespace App\Transformers;
use App\Todo;
use League\Fractal;

class ToDoTransformer extends Fractal\TransformerAbstract
{
	public function transform(Todo $todo)
	{
	    return [
	        'id'      => (int) $todo->id,
	        'name'   => $todo->name,
            'description'    =>  $todo->description,
            'status'    =>  $todo->status,
            'category_id'    =>  $todo->category_id,
            'user_id'    =>  $todo->user_id,
	        'created_at'    =>  $todo->created_at->format('d-m-Y'),
	        'updated_at'    =>  $todo->updated_at->format('d-m-Y'),
            'links'   => [
                [
                    'uri' => 'todo/show/'.$todo->id,
                ]
            ],
	    ];
	}
}