<?php

namespace App\Http\Repositories\Api;

use App\Models\Category;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\Api\CategoryInterface;
use Illuminate\Validation\ValidationException;

class CategoryRepository implements CategoryInterface
{

    use ApiResponseTrait;

    private $categoryModel;
    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }
    public function index()
    {   
        try {
            $categories = $this->categoryModel->get();
            return $this->apiResponse('200', 'Success', null, $categories);
        } catch (\Exception $e) {
            return $this->apiResponse('400', 'Error', $e->getMessage());
        }
    }

    public function store($request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required'],
            ]);
        
           $category= $this->categoryModel->create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
            return $this->apiResponse('200', 'Category Created Successfully' , null,$category);
        } catch (ValidationException $e) {
            return $this->apiResponse('401', 'Validation Error', $e->validator->errors());

        } catch (\Exception $e) {
        
            return $this->apiResponse('500', 'Error', $e->getMessage());
        }
        
    }

    public function update($request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required'],
            ]);
        
            $category = $this->categoryModel->find($request->id);
        
            if (!$category) {
                return $this->apiResponse('404', 'Category not found');
            }
        
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
            return $this->apiResponse('200', 'Category Updated Successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            
            return $this->apiResponse('401', 'Validation Error', $e->validator->errors());
        } catch (\Exception $e) {
          
            return $this->apiResponse('500', 'Error', $e->getMessage());
        }
        
    }
    public function delete($id)
    {
        try {
            $category=$this->categoryModel->find($id);
            if (!$category) {
                return $this->apiResponse('404', 'Category not found');
            }
            $category->delete();
    
            return $this->apiResponse('200', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            return $this->apiResponse('500', 'Error', $e->getMessage());
        }
    }
}
