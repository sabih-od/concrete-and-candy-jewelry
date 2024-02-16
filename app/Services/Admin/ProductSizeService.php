<?php

namespace App\Services\Admin;

use App\Models\ProductSize;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ProductSizeService
{
    private static $instance;
    /**
     * @var ProductSize
     */
    public $productSizeModel;

    private function __construct()
    {
        $this->productSizeModel = new ProductSize();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ProductSizeService();
        }
        return self::$instance;
    }

    public function getAllSizes()
    {
        return $this->productSizeModel->get();
    }

    public function datatable()
    {
        $sizes = $this->getAllSizes();

        return DataTables::of($sizes)
            ->editColumn('created_at', function ($data) {
                $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                return $formattedDate;
            })
            ->addColumn('action', function ($data) {
                $editRoute = route('admin.size.edit', ['size' => $data->id]);
                $deleteRoute = route('admin.size.destroy', ['size' => $data->id]);

                return $data->status == 0 ?
                    '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>'
                    : '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning JSON Data To Client Side
    }


    public function createSize($sizeData)
    {
        $this->productSizeModel->create($sizeData);
    }

    public function getSize($sizeId)
    {
        return $this->productSizeModel->find($sizeId);
    }

    public function updateSize($size, $sizeData)
    {
        if ($sizeData) {
            $size->update($sizeData);
        }
        return $size;
    }

    public function deleteSize($size)
    {
        if ($size) {
            $size->delete();
        }
    }


}
