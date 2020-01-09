<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' => 'success',
            'result' => Category::paginate(5)
        ]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
         ]);
         
         $categoryData=Category::Create([
            'name'=>$request->name,
        ]);

        return response()->json([
            'status'=>true,
            'code'=>200,
            'message' => 'success',
            'TodoData'=>$categoryData
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Category = Category::where('id', $id)->get();
        
        return response()->json([
                'status'=>true,
                'code'=>200,
                'message' => 'success',
                'TodoData'=>$Category
            ]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
            $this->validate($request, [
                'name' => 'filled',
             ]);

            $category = category::find($id);
            if($category->fill($request->all())->save()){
               return response()->json([
                'status'=>true,
                'code'=>200,
                'message' => 'success',
                'TodoData'=>$category
            ]);
            }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(category::destroy($id)){
            return response()->json([
               'status'=>true,
               'code'=>200,
               'message' => 'success']);
       }else{
           return response()->json([
               'status'=>false,
               'code'=>404,
               'message' => 'Faild']);
       }
    }

}
