<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SubCategory;
use App\Model\Category;
use Auth;

class SubCategoryController extends Controller
{
    public $table = '';
    function __construct()
    {
        $this->table =  (new SubCategory)->getTable();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = SubCategory::with(['category'])->get();

        return view('admin.subCategory.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $category = $category->with(['subcategories']);
        $categorys = $category->get();
        return view('admin.subCategory.add',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->fun_validation($request);

        try{
            $input = $request->all();
            $input['created_by'] = Auth::user()->id;
            $input['category_id'] =  (int)$request->category;
            // dd($input);
            $subcategory = SubCategory::create($input);
        }catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return redirect()->route('subCategories.index')
        ->with('success','subcategory created successfully');
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
        $edit = SubCategory::findOrFail($id);
        $category = new Category();
        $category = $category->with(['subcategories']);
        $categorys = $category->get();
        return view('admin.subCategory.edit',compact('edit','categorys'));
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
        $this->fun_validation($request,$id);

        try{
            $input = $request->all();
            $subcategory = SubCategory::findOrFail($id,'id');
            $subcategory->update($input);
        }catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('subCategories.index')
        ->with('success','SubCategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $subcategory= SubCategory::findOrFail($id,'id');
            $subcategory->delete();
        }catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return redirect()->route('subCategories.index')
        ->with('success','SubCategory deleted successfully');
    }

    public function fun_validation($request,$id=''){

    if($id != ''){
        $subcategory = 'required|unique:'.$this->table.',name,'.$id  ;
    }
    else{
        $subcategory = 'required|unique:'.$this->table.',name';
    }
    $rules = array(
        'category'=>'required',
        'name' => $subcategory,
    );

    $this->validate($request,$rules);

}
}
