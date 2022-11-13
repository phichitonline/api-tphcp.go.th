<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::all();
        // return Product::orderBy('id', 'desc')->paginate(25);
        return Product::with('users','users')->orderBy('id', 'desc')->paginate(25);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->tokenCan("1")){
            $request->validate([
                'name' => 'required|min:5',
                'slug' => 'required',
                'price' => 'required'
            ]);

            // กำหนดตัวแปรรับค่าจาก form
            $data_product = array(
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'user_id' => $user->id,
            );

            // รับไฟล์ภาพเข้ามา
            $image = $request->file('file');

            // ถ้าผู้ใช้ไม่ได้อับโหลดรูปภาพเข้ามา
            if(!empty($image)){
                // อับโหลดรูป
                // เปลี่ยนชื่อรูปที่ได้
                $file_name = "product_".time().".".$image->getClientOriginalExtension();

                // กำหนดขนาดของรูป
                $imgWidth = 400;
                $imgHeight = 400;
                $folderupload = public_path('/images/products/thumbnail');
                $path = $folderupload."/".$file_name;

                // อับโหลดเข้าโฟลเดอร์ thumbnail
                $img = Image::make($image->getRealPath());
                $img->orientate()->fit($imgWidth,$imgHeight, function($constraint){
                    $constraint->upsize();
                });
                $img->save($path);

                // อับโหลดภาพต้นฉบับเข้าโฟลเดอร์ original
                $destinationPath = public_path('/images/products/original');
                $image->move($destinationPath, $file_name);

                // กำหนด path ของรูปเพื่อใส่ url ในตารางฐานข้อมูล
                $data_product['image'] = url('/').'/images/products/thumbnail/'.$file_name;
            } else {
                $data_product['image'] = url('/').'/images/products/thumbnail/no_img.jpg';
            }

            return Product::create($data_product);

        } else {
            return [
                'status' => 'Permission denied to create'
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // เช็คสิทธิ์ (role) ว่าเป็น admin (1)
        $user = auth()->user();

        if($user->tokenCan("1")){

            $request->validate([
                'name' => 'required',
                'slug' => 'required',
                'price' => 'required'
            ]);

            $data_product = array(
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'slug' => $request->input('slug'),
                'price' => $request->input('price'),
                'user_id' => $user->id
            );

            // รับภาพเข้ามา
            $image = $request->file('file');

            if (!empty($image)) {

                $file_name = "product_" . time() . "." . $image->getClientOriginalExtension();

                $imgwidth = 400;
                $imgHeight = 400;
                $folderupload = public_path('/images/products/thumbnail');
                $path = $folderupload . '/' . $file_name;

                // uploade to folder thumbnail
                $img = Image::make($image->getRealPath());
                $img->orientate()->fit($imgwidth, $imgHeight, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($path);

                // uploade to folder original
                $destinationPath = public_path('/images/products/original');
                $image->move($destinationPath, $file_name);

                $data_product['image'] = url('/').'/images/products/thumbnail/'.$file_name;

            }

            $product = Product::find($id);
            $product->update($data_product);

            return $product;

        }else{
            return [
                'status' => 'Permission denied to create'
            ];
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if ($user->tokenCan("1")){
            return Product::destroy($id);
        } else {
            return [
                'status' => 'Permission denied to destroy'
            ];
        }
    }

    /**
     * Search for a name
     *
     * @param  string $keyword
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function search($keyword)
    {
        return Product::with('users','users')
                        ->where('name','like','%'.$keyword.'%')
                        ->orderBy('id','desc')
                        ->paginate(25);
        // SELECT * FROM products INNER JOIN users
        // ON (products.user_id=users.id)
        // WHERE products.name like '%sam%'
        // ORDER BY products.id DESC LIMIT 0,25
    }

}
