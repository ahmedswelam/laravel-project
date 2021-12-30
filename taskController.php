<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tasks;
use App\Models\users;


class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       


    public function index()
    {
        //
        $data = tasks::get();
        return view('tasks.index',['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $data = $this->validate($request,[
            "title"       => "required|string",
            "description" => "required",
            "start_time"   => "required",
            "end_time"     => "required",
            "image"       => "required|image|mimes:png,jpg,jpeg,gif"
        ]);
        $time_start = $request->input('start_time');

        $time_end = $request->input('end_time');

        //image upload
        $image = time().rand().'.'. $request->image->extension();

        if($request->image->move(public_path('tasksimages'),$image)){

            $data['image']     = $image;
            $data["start_time"] = $time_start;
            $data["end_time"] = $time_end;

            $op = tasks::create($data);

            if($op){
                $message = "Raw inserted";
            }else{
                $message = "Error Try Again";
            }
        }else{
            $message = "Error In Uploadin Try Again";
        }
        session()->flash('Message',$message);

        return redirect(url('/tasks'));

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = tasks::find($id);
        return view('tasks.edit',['data' => $data]);
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
              //validation
              $data = $this->validate($request,[
                "title"       => "required|string",
                "description" => "required",
                "start_time"   => "required",
                "end_time"     => "required",
                "image"       => "required|image|mimes:png,jpg,jpeg,gif"
            ]);
            $time_start = $request->input('start_time');

            $time_end = $request->input('end_time');
    
            //image upload
            $image = time().rand().'.'. $request->image->extension();
    
            if($request->image->move(public_path('tasksimages'),$image)){

                $data['image']     = $image;
                $data["start_time"] = $time_start;
                $data["end_time"] = $time_end;
    
            $op =   tasks::where('id',$request->id)->update($data);

            if($op){
                $message = "Raw Updated";
            }else{
                $message = "Error Try Again";
            }
        }else{

        }     
            session()->flash('Message',$message);
     
            return redirect(url('/tasks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = tasks::find($id);

         $op = tasks::where('id',$id)->delete();

          if($op){

             unlink(public_path('tasksimages/'.$data->image));

              $message = "Raw Removed";
          }else{
              $message = "Errot Try Again";
          }

          session()->flash('Message',$message);

          return redirect(url('/tasks'));
    }

      
    public function Login(){
        return view('tasks.login');
    }

    public function DoLogin(Request $request){
        // logic .....
            
        $data = $this->validate($request,[
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);
            
        # Fetch users Data ....
            //$users_data = users::get('email');
            $userdata = array(
                'email' => users::get('email') ,
                'password' => users::get('password')
              );
              

          if(auth('users')->attempt($userdata)){
              return redirect(url('/tasks'));
          }else{
              return redirect('login');
          }
             
            // with this you can get the info of the user logged in
            // $loggedUser = auth()->user();
            // check from $request->user() if auth()->user() not working
            $message = ( $request->user() ) ? ['message' => 'Logged In'] : ['message' => 
                       'Not Logged In'];
            return response()->json($message);
  
    }
  
  
  
    public function logout(){
        auth('users')->logout();
        return redirect(url('/Login'));
    }
}
