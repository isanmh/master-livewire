<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsApiController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->paginate(5);
        // $products->load('category');

        $products = Product::with('category')->paginate(5);
        return response()->json(
            $products,
            Response::HTTP_OK
        );
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        // jika data tidak ditemukan
        if (is_null($product)) {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Data produk tidak ditemukan',
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        } else {
            $data = [
                'status' => Response::HTTP_OK,
                'message' => 'Data produk berhasil ditemukan',
                'data' => $product
            ];
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric',
            'description' => 'required|max:255|string',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            // $destinationPath = public_path('assets/images');
            // $image->move($destinationPath, $imageName);
            $image->storeAs('assets/images', $imageName, 'public');
            $input['image'] = $imageName;
        } else {
            $input['image'] = '';
        }

        Product::create($input);

        $data = [
            'status' => Response::HTTP_CREATED,
            'message' => 'Data produk berhasil ditambahkan',
            'data' => $input
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $input = $request->validate([
                'name' => 'max:255|string',
                'price' => 'numeric',
                'description' => 'max:255|string',
                'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
                'category_id' => 'exists:categories,id'
            ]);

            $input = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                // delete old image
                if ($product->image) {
                    unlink(storage_path('app/public/assets/images/' . $product->image));
                }
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('assets/images', $imageName, 'public');
                $input['image'] = $imageName;
            } else {
                $input['image'] = $product->image;
            }

            $product->update($input);
            $data = [
                'status' => Response::HTTP_OK,
                'message' => 'Data produk berhasil diupdate',
                'data' => $product
            ];
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Data produk tidak ditemukan',
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            if ($product->image) {
                unlink(storage_path('app/public/assets/images/' . $product->image));
            }
            $product->delete();
            $data = [
                'status' => Response::HTTP_OK,
                'message' => 'Data produk berhasil dihapus',
            ];
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Data produk tidak ditemukan',
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
