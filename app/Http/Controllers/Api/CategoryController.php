<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\CategoryInterface;

class CategoryController extends Controller
{
    private $categoryInterface;
    public function __construct(CategoryInterface $category)
    {
        $this->categoryInterface = $category;
    }

    public function index()
    {
        return $this->categoryInterface->index();
    }

    public function store(Request $requset)
    {
        return $this->categoryInterface->store($requset);
    }
   
    public function update(Request $requset)
    {
        return $this->categoryInterface->update($requset);
    }
    public function delete($id)
    {
        return $this->categoryInterface->delete($id);
    }
}
