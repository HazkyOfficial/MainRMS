<?php

namespace App\Http\Controllers;
//==========================================================    USE PART    ===============================
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\clas;
//=========================================================================================================

class MyController extends Controller
{
    //
//==========================================================    Navigation parts    =======================
    public function home(){
        return view('home');
    }

    public function results(){
        return view('results');
    }

    public function student(){
        return view('student');
    }

    public function class(){
        $class = DB::table('clas')->get();  //Get All class table contants from class table(DB)
        return view('class',compact('class'));  //send all class details to class page(class.blad.php)
    }

    public function teacher(){
        return view('teacher');
    }

    public function subject(){
        return view('subject');
    }

    public function result(){
        return view('result');
    }

    public function admin(){
        return view('admin');
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }
//========================================================================================================

//==========================================================    Database Connections    ==================

    public function addclass(Request $req)
    {
        $req->validate([
            'CName'=>'required|min:4',
            'CType'=>'required',
            

        ],[
            //Class name Add
            'CName.required'=>'Class Name is must',
            'CName.min'=>'Class Name Minimum 4 letters must',

            //Class Type Add
            'CType.required'=>'Please select Class Type',
        ]);

        $cnt = count(DB::table('clas')->get());
        
        $cls = new clas;
        $cls->class_name = $req->CName;
        $cls->class_type = $req->CType;

        $cls->save();

        return redirect()->back()->with('msg',"class is saved");
    }

    public function getclass(){
        $cs = DB::table('clas')->get();

        return view('viewclass',compact('cs'));
    }


    public function editclass(Request $req) {

        $req->validate([
            'ECName'=>'required|min:4',
            'ECType'=>'required',
            
        ],[
            //Class name Add
            'ECName.required'=>'Class Name is must',
            'ECName.min'=>'Class Name Minimum 4 letters must',

            //Class Type Add
            'ECType.required'=>'Please select Class Type',
        ]);

        DB::table('clas')->where('id' , $req->ECId)->update([
            'class_name' => $req->ECName,
            'class_type' => $req->ECType,
            
        ]);

        return redirect()->back()->with('msg',"class is updated");
    }

    public function delete($i)  //passing variable
    {
        DB::table('clas')->where('id',$i)->delete();
        
        return redirect()->back()->with('msg',"class is delete");
    }
}
