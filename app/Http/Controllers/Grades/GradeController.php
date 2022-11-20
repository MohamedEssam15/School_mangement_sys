<?php

namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;

use App\Models\grade;
use App\Models\classroom;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades=Grade::all();
       return view("pages.grades.grades",compact('Grades'));
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
        if(grade::where("Name->ar",$request->Name)->orwhere("Name->en",$request->Name_en)->exists()){
            return redirect()->back()->withErrors([trans('massages.exists')]);
        }
        try{
            $request->validate([
                'Name' => 'required',

                'Name_en' => 'required',
            ],[
                'Name.required' => trans("massages.Name_required"),
                'Name_en.required' => trans("massages.Name_en_required"),

            ]);
            $Grade = new grade();

          $translations = [
              'en' => $request->Name_en,
              'ar' => $request->Name
          ];
          $Grade->setTranslations('Name', $translations);
          $Grade->Notes=$request->Notes;
          $Grade->save();
            toastr()->success(trans('massages.success'));
            return redirect()->route('Grades.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, grade $grade)
    {
        try{
            $request->validate([
                'Name' => 'required',

                'Name_en' => 'required',
            ],[
                'Name.required' => trans("massages.Name_required"),
                'Name_en.required' => trans("massages.Name_en_required"),

            ]);
            $Grade = grade::where('id',$request->id)->first();

          $translations = [
              'en' => $request->Name_en,
              'ar' => $request->Name
          ];
          $Grade->setTranslations('Name', $translations);
          $Grade->Notes=$request->Notes;
          $Grade->save();

          toastr()->success(trans('massages.Update'));
          //toastr()->info(trans('massages.Update'));
            return redirect()->route('Grades.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if(classroom::where('Grade_id',$request->id)->exists()){
         return redirect()->back()->withErrors(['error' => trans('Grades_trans.delete_Grade_Error')]);
        }else{
            $grade= grade::where('id',$request->id)->first();
            $grade->forceDelete();
            toastr()->warning(trans('massages.Delete'));
            return redirect()->route('Grades.index');
        }

    }
}
