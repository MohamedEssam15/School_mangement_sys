<?php

namespace App\Http\Controllers\classrooms;
use App\Http\Controllers\Controller;

use App\Models\classroom;
use Illuminate\Http\Request;
use App\Models\grade;
class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = grade::all();
        return view('pages.classrooms.classrooms',compact('My_Classes','Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $List_Classes = $request->List_Classes;

        try {
            $request->validate([
                'List_Classes.*.Name' => 'required',
                'List_Classes.*.Name_class_en' => 'required',
            ],[
                'Name.required' => trans("massages.Name_required"),
                'Name_class_en.required' => trans("massages.Name_en_required"),

            ]);

            foreach ($List_Classes as $List_Class) {


                $My_Classes = new Classroom();
                $translations = [
                    'en' => $List_Class['Name_class_en'],
                    'ar' => $List_Class['Name']
                ];
                $My_Classes->setTranslations('Name_Class', $translations);
                $My_Classes->Grade_id = $List_Class['Grade_id'];
                $My_Classes->save();

            }

            toastr()->success(trans('massages.success'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $request->validate([
                'Name' => 'required',

                'Name_en' => 'required',
            ],[
                'Name.required' => trans("massages.Name_required"),
                'Name_en.required' => trans("massages.Name_en_required"),

            ]);
            $classroom = classroom::where('id',$request->id)->first();

          $translations = [
              'en' => $request->Name_en,
              'ar' => $request->Name
          ];
          $classroom->setTranslations('Name_Class', $translations);
          $classroom->Grade_id=$request->Grade_id;
          $classroom->save();

          toastr()->success(trans('massages.Update'));
          //toastr()->info(trans('massages.Update'));
            return redirect()->route('classrooms.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $classroom = classroom::where('id',$request->id)->first();
        $classroom->forceDelete();
        toastr()->warning(trans('massages.Delete'));
        return redirect()->route('classrooms.index');
    }
    public function delete_all(Request $request)
    {

        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();

    }
    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
        return view('pages.classrooms.classrooms',compact('Grades'))->withDetails($Search);

    }
}
