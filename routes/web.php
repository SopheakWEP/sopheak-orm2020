<?php

use Illuminate\Support\Facades\Route;
use App\Products;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/add", function() {
    $pro = new Products;
    $pro->name = 'Banana';
    $pro->code = 'B01';
    $pro->description = 'Apple fruit description';

    $pro->save();

    echo 'inserted success!!';
});

Route::get("/update/{id}", function($id){
    $pro = Products::find($id);
    $pro->name = 'Banana';
    $pro->code = 'B01';
    $pro->description = 'Banan fruit description updated!!';

    $pro->save();
    echo 'updated!!';
});

Route::get("raw-select", function(){
    $query = DB::select("Select * from products");
    return $query;
});

Route::get("select-condition/{id}", function($id){
    // $query = DB::table('products')->where('id', $id)->get();
    $query = DB::table('products')->where('id', $id)->where('deleted_at', null)->get();
    return $query;
});

Route::get("get-product/{id}", function($id){
    $pro = Products::find($id);
    echo 'Product name: ' . $pro->name . ', code: ' . $pro->code . ', description: ' . $pro->description;
});

Route::get("/get-all", function(){
    $pro = Products::get();
    echo $pro;
});

Route::get("delete/{id}", function($id){
    $pro = Products::find($id);
    $pro->delete();
    echo 'deleted';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
