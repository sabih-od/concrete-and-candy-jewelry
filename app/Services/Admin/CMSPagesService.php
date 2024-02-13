<?php

namespace App\Services\Admin;

use App\Models\CMSPages;
use Illuminate\Http\Request;

class CMSPagesService
{
    private static $instance;

    public function __construct()
    {
        $this->cmsModel = new CMSPages();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new CMSPagesService();
        }
        return self::$instance;
    }

    public function getPageBySlug($slug)
    {
        $page = $this->cmsModel->PageBySlug($slug)->first();

        if ($page) {
            $page->content = json_decode($page->content, true);
        }
        return $page;
    }

    public function updatePageBySlugWithMedia(Request $request)
    {
        $slug = $request->input('slug');
        $mediaCollections = $request->input('media_collections', []);

        $page = $this->cmsModel->PageBySlug($slug)->firstOrFail();

        $content = $request->except(['_token', '_method']);
        $content = array_filter($content);

        $page->update([
            'content' => json_encode($content),
            'meta_title' => $request->input('meta_title', ''),
            'meta_description' => $request->input('meta_description', ''),
        ]);

        foreach ($mediaCollections as $collectionName) {
            $this->addOrUpdateMedia($page, $request, $collectionName);
        }

        return $page;
    }

    public function addOrUpdateMedia(CMSPages $page, Request $request, $collectionName)
    {
        if ($request->hasFile($collectionName)) {
            if ($page->hasMedia($collectionName)) {
                $page->clearMediaCollection($collectionName);
            }

            $page->addMediaFromRequest($collectionName)->toMediaCollection($collectionName);
        }
    }

    public function getMediaUrls(CMSPages $page, $collectionName)
    {
        return $page->getMedia($collectionName)->map(function ($item) {
            return $item->getUrl();
        });
    }

    public function viewReturn($slug, $content, $page)
    {
        switch ($slug) {
            case 'home':
                return view('admin.pages.cms.home', compact('content', 'page', 'slug'));
                break;

            case 'about':
                return view('admin.pages.cms.about', compact('content', 'page', 'slug'));
                break;

            case 'contact':
                return view('admin.pages.cms.contact', compact('content', 'page', 'slug'));
                break;

            case 'category':
                return view('admin.pages.cms.category', compact('content', 'page', 'slug'));
                break;

            case 'shop':
                return view('admin.pages.cms.shop', compact('content', 'page', 'slug'));
                break;

            case 'faq':
                return view('admin.pages.cms.faq', compact('content', 'page', 'slug'));
                break;

            case 'footer':
                return view('admin.pages.cms.footer', compact('content', 'page', 'slug'));
                break;

            default:
                abort(404);
        }
    }

}
