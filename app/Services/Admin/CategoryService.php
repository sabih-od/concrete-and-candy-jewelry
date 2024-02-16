<?php

namespace App\Services\Admin;

use App\Models\Category;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
    private static $instance;
    /**
     * @var Category
     */
    private $categoryModel;

    private function __construct()
    {
        $this->categoryModel = new Category();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new CategoryService();
        }
        return self::$instance;
    }

    public function getAllCategoriesWithLimit($limit = null)
    {
        if ($limit != null) {
            return $this->categoryModel->limit($limit)->get();
        }
        return $this->categoryModel->get();

    }

    public function getAllCategories($slug = null)
    {
        $parent_categories = $this->categoryModel
            ->get();

        if ($slug != null) {
            return $this->attachSlugCategory($slug, $parent_categories);
        }
        return $parent_categories;
    }


    public function attachSlugCategory($slug, $parent_categories)
    {
        $slugCategory = $this->categoryModel
            ->getSlugCategory($slug)
            ->first();
        if ($slugCategory && $slugCategory->parent_id != 0) {
            $categories = $this->categoryModel->getParentCategories()
                ->get();
            $categories[] = $slugCategory;

            return $categories;
        }
        return $parent_categories;
    }


    public function datatable()
    {
        $categories = $this->getAllCategoriesWithLimit();

        return DataTables::of($categories)
            ->editColumn('created_at', function ($data) {
                $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                return $formattedDate;
            })
            ->addColumn('action', function ($data) {
                $editRoute = route('admin.category.edit', ['category' => $data->id]);
                $deleteRoute = route('admin.category.destroy', ['category' => $data->id]);

                return $data->status == 0 ?
                    '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>'
                    : '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning JSON Data To Client Side
    }


    public function createCategory($categoryData)
    {
        $category = $this->categoryModel->create($categoryData);
        $this->addOrUpdateImage($category, $categoryData['category_img'], false);
        return true;
    }

    public function getCategory($categoryId)
    {
        return $this->categoryModel->find($categoryId);
    }

    public function getCategoryBySlug($categorySlug)
    {
        return $this->categoryModel->where('slug', $categorySlug)->first();
    }

    public function updateCategory($category, $categoryData)
    {
        if ($categoryData) {
            $category->update($categoryData);
//            if ($categoryData['category_img'] ?? null !== null) {
            if (isset($categoryData['category_img']) && $categoryData['category_img'] != null) {
                $this->addOrUpdateImage($category, $categoryData['category_img'], true);
            }
        }
        return $category;
    }

    public function deleteCategory($category)
    {
        $category->delete();
        return true;
    }

    public function addOrUpdateImage($category, $img, $update)
    {
        if ($update) {
            $category->clearMediaCollection('category_img');
        }
        $category->addMedia($img)
            ->toMediaCollection('category_img');
    }


}
