<?php
namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\grade;
use App\Models\section;
use App\Models\teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $Grades = grade::with(['Sections'])->get();
    $list_Grades = grade::all();
    $teachers =teacher::all();
    return view('pages.Sections.Sections',compact('Grades','list_Grades','teachers'));
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

        try {

            $request->validate([
                'Name_Section_Ar' => 'required',

                'Name_Section_En' => 'required',
            ],[
                'Name_Section_Ar.required' => trans("massages.Name_required"),
                'Name_Section_En.required' => trans("massages.Name_en_required"),

            ]);

          $translations = [
            'en' => $request->Name_Section_En,
            'ar' => $request->Name_Section_Ar
        ];
            $Sections = new Section();
            $Sections->setTranslations('Name_Section', $translations);
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);
            toastr()->success(trans('massages.success'));

            return redirect()->route('Sections.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $request->validate([
                'Name_Section_Ar' => 'required',

                'Name_Section_En' => 'required',
            ],[
                'Name_Section_Ar.required' => trans("massages.Name_required"),
                'Name_Section_En.required' => trans("massages.Name_en_required"),

            ]);
            $Sections = section::where('id',$request->id)->first();

          $translations = [
              'en' => $request->Name_Section_En,
              'ar' => $request->Name_Section_Ar
          ];
            $Sections->setTranslations('Name_Section', $translations);
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            if(isset($request->Status)) {
                $Sections->Status = 1;
              } else {
                $Sections->Status = 2;
              }
              if (isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id);
            } else {
                $Sections->teachers()->sync(array());
            }
            $Sections->save();
          toastr()->success(trans('massages.Update'));

          return redirect()->route('Sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
    toastr()->error(trans('massages.Delete'));
    return redirect()->route('Sections.index');
    }
    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }
}
