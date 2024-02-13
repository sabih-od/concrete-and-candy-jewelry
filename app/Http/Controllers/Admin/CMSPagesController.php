<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Services\Admin\CMSPagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMSPagesController extends AdminBaseController
{

    protected $cmsPagesService;

    public function __construct(CMSPagesService $cmsPagesService)
    {
        $this->cmsPagesService = $cmsPagesService;
    }

    public function edit($slug)
    {
        try {
            $page = $this->cmsPagesService->getPageBySlug($slug);
            $content = $page->content;
            
            return $this->cmsPagesService->viewReturn($slug, $content, $page);
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function editAndUpdate(Request $request, $slug)
    {
        try {
            DB::beginTransaction();
            $page = $this->cmsPagesService->getPageBySlug($slug);
            if (!$page) {
                abort(404);
            }
            $this->cmsPagesService->updatePageBySlugWithMedia($request);
            DB::commit();
            return WebResponses::successRedirectBack('Page updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


}
