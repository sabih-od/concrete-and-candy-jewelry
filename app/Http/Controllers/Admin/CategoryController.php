<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\admin\CategoryRequest;

class CategoryController extends AdminBaseController
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        try {
            $categories = $this->categoryService->getAllCategoriesWithLimit();
            if ($request->ajax()) {
                return $this->categoryService->datatable();
            }
            return view('admin.pages.category.index', compact('categories'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function create()
    {
        try {
            $categories = $this->categoryService->getAllCategoriesWithLimit();

            return view('admin.pages.category.create', compact('categories'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryService->createCategory($request->all());

            return WebResponses::successRedirect('admin.category.index', 'Category Added successfully');

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function show(Category $category)
    {
        try {

            $categories = $this->categoryService->getAllCategoriesWithLimit();
            return view('admin.pages.category.edit', compact('category', 'categories'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function update(Request $request, Category $category)
    {
        $user = $this->categoryService->updateCategory($category, $request->all());
        if ($user) {
            return WebResponses::successRedirect('admin.category.index', 'Category Updated successfully');
        }
        return WebResponses::errorRedirectBack('Category not found');
    }


    public
    function destroy(Category $category)
    {
        try {
            $this->categoryService->deleteCategory($category);
            return WebResponses::successRedirect('admin.category.index', 'Category Deleted successfully');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


}
