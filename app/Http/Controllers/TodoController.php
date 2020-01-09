<?php
 
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Todo;
    use Illuminate\Support\Facades\Auth;
    use League\Fractal;
    use League\Fractal\Manager;
    use League\Fractal\Resource\Item;
    use League\Fractal\Resource\Collection;
    use League\Fractal\Pagination\IlluminatePaginatorAdapter;
    use App\Transformers\ToDoTransformer;

    class TodoController extends Controller
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        private $fractal;

        public function __construct()
        {
            $this->middleware('auth');
            $this->fractal = new Manager(); 
        }
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
             
            $paginator = Todo::paginate();
            $todo = $paginator->getCollection();
            $resource = new Collection($todo, new ToDoTransformer);
            $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
            return $this->fractal->createData($resource)->toArray();
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
                'name' => 'required',
                'status' => 'required',
                'description' => 'required',
                'category_id' => 'required'
             ]);
             
            $todoData=Todo::create([
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'user_id'=>Auth::user()->id
            ]);

            if($todoData){
               return response()->json([
                    'status'=>true,
                    'code'=>200,
                    'message' => 'success',
                    'TodoData'=>$todoData
                ]);
            }else{
                 return response()->json([
                     'status'=>false,
                     'code'=>404,
                     'message' => 'fail'
                ]);
            }
        }
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $todo = Todo::where('id', $id)->get();
            return response()->json([
                    'status'=>true,
                    'code'=>200,
                    'message' => 'success',
                    'TodoData'=>$todo
                ]);
            
        }
      
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $this->validate($request, [
                'name' => 'required',
                'status' => 'required',
                'description' => 'required',
                'category_id' => 'required'
             ]);

            $todo = Todo::find($id);
            if($todo->fill($request->all())->save()){
               return response()->json([
                'status'=>true,
                'code'=>200,
                'message' => 'success',
                'TodoData'=>$todo
            ]);
            }
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message' => 'failed'
            ]);
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            if(Todo::destroy($id)){
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
        /**
         * Display the specified resource.
         *
         * @param  string  $month 
         * @return \Illuminate\Http\Response
         */
        public function filter(Request $request,Todo $Todo){

            $toDoResult = Auth::user()->todo();

            // Search for a toDo based on Month.
            if ($request->has('month')) {

                $month = $request->input('month'); 
                //validate incoming request 
                $this->validate($request, [
                    'month' => 'digits_between:1,2',
                ]);
                
                $toDoResult->whereRaw('MONTH(created_at) = '.$month);
            }

            // Search for a toDo based on Month.
            if ($request->has('year')) {

                $year = $request->input('year'); 
                //validate incoming request 
                $this->validate($request, [
                    'year' => 'digits_between:1,4',
                ]);
                $toDoResult->whereRaw('YEAR(created_at) = '.$year);
            }

             // Search for a toDo based on category_id.
             if ($request->has('category_id')) {

                $category_id = $request->input('category_id'); 
                $toDoResult->where('category_id', $category_id);
            }

             // Search for a toDo based on status.
             if ($request->has('status')) {

                $status= $request->input('status'); 
                $toDoResult->where('status', $status);
            }
             
                $toDoData= $toDoResult->paginate(5);
                
                if($toDoData->count() > 0){
                    return response()->json([
                        'status'=>true,
                        'code'=>200,
                        'message' => 'success',
                        'TodoData'=>$toDoData
                    ]);
                }else{
                    return response()->json([
                        'status'=>false,
                        'code'=>404,
                        'message' => 'Falid'
                    ]);
                }
            

            
        }
    }
?>