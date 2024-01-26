<?php

namespace App\Http\Repositories\Api;

use App\Models\Product;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Interfaces\Api\ProductInterface;
use Illuminate\Validation\ValidationException;


class ProductRepository implements ProductInterface
{

    use ApiResponseTrait;
    private $productModel;
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }
    public function index()
    {
        try {
            $products = $this->productModel->get();
            return $this->apiResponse('200', 'success', null, $products);
        } catch (\Exception $e) {
            return $this->apiResponse('400', 'Error', $e->getMessage());
        }
    }

    public function store($request)
    {
        try {
            $request->validate(
                [
                    'name' => ['required', 'string'],
                    'description' => ['required'],
                    'price' => ['required', 'numeric'],
                    'category_id' => ['required', 'exists:categories,id'],
                    'image' => ['required', 'image', 'mimes:png,jpg'],
                ]
            );
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product = $this->productModel->create([
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'category_id' => $request['category_id'],
                'image' => $imagePath,
            ]);

            return $this->apiResponse('200', 'Product Created Successfully', $product);
        } catch (ValidationException $e) {
            return $this->apiResponse('401', 'Validation Error', $e->validator->errors());
        } catch (\Exception $e) {

            return $this->apiResponse('500', 'Error', $e->getMessage());
        }
    }

    public function update($request, $id)
    {

        try {

            $validatedData = $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required'],
                'price' => ['required', 'numeric'],
                'category_id' => ['required', 'exists:categories,id'],
                'image' => ['required', 'image', 'mimes:png,jpg'],
            ]);

            $product = $this->productModel->find($id);


            if (!$product) {
                return $this->apiResponse('404', 'Product not found');
            }


            Storage::disk('public')->delete($product->image);
            $imagePath = $request->file('image')->store('product_images', 'public');


            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'category_id' => $validatedData['category_id'],
                'image' => $imagePath,
            ]);

            return $this->apiResponse('200', 'Product Updated Successfully', $product);
        } catch (ValidationException $e) {

            return $this->apiResponse('401', 'Validation Error', $e->validator->errors());
        } catch (\Exception $e) {

            return $this->apiResponse('500', 'Error', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $product = $this->productModel->find($id);
            if (!$product) {
                return $this->apiResponse('404', 'Product not found');
            }
            Storage::disk('public')->delete($product->image);
            $product->delete();

            return $this->apiResponse('200', 'Product Deleted Successfully');
        } catch (\Exception $e) {
            return $this->apiResponse('500', 'Error', $e->getMessage());
        }
    }
}
