<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NewDatabaseController extends Controller

{
    public function create(){
        return view('example');
    }
    //
    public function store(Request $request){
        $request->validate([
            // 'id'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'contact'=>'required',
            'place'=>'required',
            'gender'=>'required',
            'qualification'=>'required|array'
        ]);
      // ✅ Convert array to string iam using this for checkbox method in qualification
    $qualification = implode(',', $request->qualification);

        DB::table('login_table')->insert([
            // 'id'=>$request->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'place'=>$request->place,
            'gender'=>$request->gender,
            'qualification'=>$qualification
        ]);
      
        return redirect()->back()->with('success','Data Inserted Successfully');
    }
    public function update(Request $request, $id)
{

 $qualification = implode(',', $request->qualification);
    DB::table('login_table')
        ->where('id', $id)
        ->update([
            // 'id'     => $request->id,
            'name'   => $request->name,
            'email'    => $request->email,
            'contact' => $request->contact,
            'place'  => $request->place,
            'gender' => $request->gender,
            'qualification' => $qualification,
            'updated_at' => now(),
        ]);

    return redirect()->back()->with('success', 'Data Updated Successfully');
}
// public function index()
//     {
  
//         $data = DB::table('login_table')->get(); // fetch all rows
//         return view('example', compact('data')); // ✅ pass $data
//     }
   public function index(Request $request)
{
    $data = DB::table('login_table')->get();   //Fetch all rows and store in $data
    $editData = null; 

    if ($request->has('edit')) {
        $editData = DB::table('login_table')
                      ->where('id', $request->edit)
                      ->first();
    }

    return view('example', compact('data', 'editData'));
}
public function delete($id)
{
    DB::table('login_table')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Data Deleted Successfully');
}
// public function deleteselected(Request $request)
// {
//     $ids = $request->selected_ids;

//     if (!$ids) {
//         return redirect()->back()->with('error', 'No records selected');
//     }

//     DB::table('login_table')->whereIn('id', $ids)->delete();

//     return redirect()->back()->with('success', 'Selected records deleted successfully');
// }
public function deleteselected(Request $request)
{
    // dd($request);
    DB::table('login_table')
      ->whereIn('id', $request->ids)
      ->delete();

    return back()->with('success', 'Selected records deleted');
}


}
