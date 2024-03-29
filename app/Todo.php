<?php
    namespace App;
    use Illuminate\Database\Eloquent\Model;

    class Todo extends Model
    {
       //
       protected $table = 'todo';
       protected $fillable = ['name','status','description','category_id','user_id'];

        /*
        * User
        *
        */
        public function user()
        {
            return $this->belongsTo(User::class);
        }

    }

?>