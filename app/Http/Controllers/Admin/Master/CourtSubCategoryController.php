<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourtType;
use App\Models\CourtGroup;
use App\Models\CourtMast;
use App\Models\CourtMastHeader;
use App\Models\State;
use App\Models\City;
class CourtSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courts = CourtMast::all();

        return view('admin.dashboard.master.court.subcategory.index',compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courtgrups = CourtGroup::all();
        $states = State::where('country_code',102)->get();
        return view('admin.dashboard.master.court.subcategory.create',compact('courtgrups','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // return $request->all();
        // $state = State::where('state_code',$request->state_code)->first();
        // $cities = City::where('state_code',$request->state_code)->get(); 

        // foreach ($cities as $city) {
        //      $data = [
        //         'court_group_code' => $request->court_group_code,
        //         'court_group_name' => 'Indian Courts',
        //         'court_type' => $request->court_type,
        //         'court_type_name' => 'District Court / Sessions Court - India',
        //         'court_name' => 'District Court',
        //         'state_code' => $state->state_code,
        //         'state_name' => $state->state_name,
        //         'city_code' => $city->city_code,
        //         'city_name' => $city->city_name,
        //         'court_shrt_name' => null,
        //         'country_code' => '102',
        //         'country_name' => 'India',
        //     ];
        //    CourtMastHeader::create($data);
        // }
       
        // return "success";

        // die;
        $data = $this->validation($request);
        $courts = CourtMast::all();
        if(count($courts) !=0){
            foreach ($courts as $value) {
               $id = $value->court_code;
            }
            $data['court_code'] = $id+1;
        }
        else{
            $id = '1';
        }

        $courtgrups = CourtGroup::find($data['court_group_code']);
        $courts_types = CourtType::find($data['court_type']);
        $data['court_type_name'] = $courts_types->court_type_desc; 

        $data['court_group_name'] = $courts_types->court_group_name; 

        CourtMast::create($data);

        return redirect()->route('court_subcategory.index')->with('success','Court Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.dashboard.master.court.subcategory.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $courtgrups = CourtGroup::all();
         $court = CourtMast::find($id);
         return view('admin.dashboard.master.court.subcategory.edit',compact('courtgrups','court'));
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
        $data = $this->validation($request);
        $courtgrups = CourtGroup::find($data['court_group_code']);
        $courts_types = CourtType::find($data['court_type']);
        $data['court_type_name'] = $courts_types->court_type_desc; 

        $data['court_group_name'] = $courts_types->court_group_name; 

        $court = CourtMast::find($id);
        $court->update($data);
        return redirect()->route('court_subcategory.index')->with('success','Court Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       CourtMast::find($id)->delete();
       return redirect()->back()->with('success','Court Deleted Successfully');
    }
    public function validation($request){
        return $request->validate([
            'court_group_code'  => 'required|not_in:0',
            'court_type'        => 'required|not_in:0',
            'court_name'        => 'required|string|max:100|min:3',
            'court_shrt_name'   => 'nullable|string|max:20|min:2',
        ]);
    }
    // public function courtTypeFilter(Request $request){
    //    $courts = CourtType::where('court_group_code',$request->court_group_code)->get();

      
    //    return response()->json($courts); 
    // }
}
