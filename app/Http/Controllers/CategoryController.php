<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use Auth;

class CategoryController extends Controller
{
    public $table = '';
    function __construct()
    {
        $this->table =  (new Category)->getTable();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::get();
        return view('admin.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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

            $input['name'] = $request->name;
            $input['created_by'] = Auth::user()->id;

            // dd($input);
            $category = Category::create($input);
        }catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('categories.index')
        ->with('success','category created successfully');
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
        $edit = Category::findOrFail($id);
        // dd($edit);
        return view('admin.category.edit',compact('edit'));
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
            $category = Category::findOrFail($id,'id');
            $category->update($input);
        }catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('categories.index')
        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= Category::findOrFail($id,'id');
        $category->delete();
        return redirect()->route('categories.index')
        ->with('success','Category deleted successfully');
    }

    public function fun_validation($request,$id=''){

        if($id != ''){
            $category = 'required|unique:'.$this->table.',name,'.$id;
        }
        else{
            $category = 'required|unique:'.$this->table.',name';
        }

        $rules = array(
            'name' => $category,
        );

        $this->validate($request,$rules);
    }
}
