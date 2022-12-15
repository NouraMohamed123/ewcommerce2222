<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use Str;
use Redirect;
use Storage;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
   
    
       $query =Category::query();
     
       if( $name = $request->query('name')){
        $query->where('name','LIKE',"%{$name}%");
       }
        if( $status = $request->query('status')){
        $query->where('status','LIKE',"%{$status}%");
       }
        $data = $query->paginate();
        return view('dashboard.categories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $parents = Category::all();
        
          return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'name'=>'required|min:3|max:255|',
        'parent_id' =>[
          'int','exists:categories,id'
        ],
        'image'=>[
          'mimes:png,jpg',
        ]
        ]);
$request->merge([
'slug'=> Str::slug($request->post('name'))
]);

$data = $request->except('image');
$data['image'] = $this->uploadImage( $request);


//erquest merge

$categories = Category::create($data);
//flash message
return Redirect::route('categories.index')->with(['success'=> 'category created']);

}

/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
}

/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
try {

$data = Category::findOrFail($id);
$parents = Category::where('id','!=',$id)
->where(function($query) use($id){
$query->whereNull('parent_id')->orwhere('parent_id','!=',$id);
})
->get();
return view('dashboard.categories.edit',compact('data','parents'));

}
catch(Exception $e){

return Redirect::route('categories.index')->with(['info'=> '!!!!!']);
}

}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{

$Category = Category::find($id);
$old_image = $Category->image;
$data = $request->except('image');


$data['image'] = $this->uploadImage( $request);


if($old_image && isset( $data['image'])) {
Storage::disk('public')->delete($old_image);
}

$Category->update($data);

return Redirect::route('categories.index')->with(['success'=> 'category updated']);
}

/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
$Category = Category::destroy($id);
if($Category->image) {
Storage::disk('public')->delete($Category->image);
}
return Redirect::route('categories.index')->with(['success'=> 'category deleted']);
}


protected function uploadImage(Request $request){

if(!$request->hasFile('image')){

return;
}
$file = $request->file('image');
$path = $file->store('uploads');
return $path;

}
}