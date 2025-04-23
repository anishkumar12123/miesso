<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;
use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    public function view_cetegory()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }
    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();

        toastr()->closeButton(true)->addSuccess('Category Added Successfully.');

        return redirect()->back();
    }
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Delete Successfully.');

        return redirect()->back();
    }
    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {

        $data = Category::find($id);

        $data->category_name = $request->category;
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Updateed Successfully.');

        return redirect('/view_cetegory');
    }
    public function add_product()
    {
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity     = $request->quantity;
        $data->category     = $request->category;

        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imageName);
            $data->image = $imageName;
        }
        $data->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product added Successfully.');

        return redirect('/product_view');
    }

    public function product_view()
    {
        $product = Product::paginate(10);
        return view('admin.product_view', compact('product'));
    }
    public function delete_product($id)
    {
        $data = Product::find($id);
        $image_path = public_path('products/' . $data->image);
        if (fileExists($image_path)) {
            unlink($image_path);
        }
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Delete Successfully.');
        return redirect('/product_view');
    }
    public function update_product($slug)
    {
        $data =  Product::where('slug',$slug)->get()->first();
        $category = Category::all();
        return view('admin.update_product', compact('data','category'));
    }

    public function edit_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('products'), $imageName);  // Use public_path
            $data->image = $imageName;
        }
        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product updated Successfully.');
        return redirect('/product_view');
    }

    public function search_product(Request $request){
        $search = $request->search;

        $product = Product::where('title','like','%'.$search.'%')->orWhere('category','like','%'.$search.'%')->paginate(7);

        return view('admin.product_view',compact('product'));

    }

    public function view_orders(){
        $data = Order::all();
     return view('admin.view_order',compact('data'));
    }

    public function on_the_way($id){

        $data = Order::find($id);

        $data->status = 'on_the_way';

        $data->save();
        return redirect('/view_order');

    }
    public function delivered($id){

        $data = Order::find($id);

        $data->status = 'delivered';

        $data->save();
        return redirect('/view_order');
    }

    public function print_pdf($id){

        $data = Order::find($id);
        $pdf = Pdf::loadView('admin.invoice',compact('data'));
    return $pdf->download('invoice.pdf');
    }
}
