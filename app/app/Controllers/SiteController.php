<?php

namespace App\Controllers;

use App\Models\NFileManagerModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class SiteController extends BaseController
{
    public function index(): string
    {
        $settings = $this->settingsModel->getAll();

        $sections = [];
        foreach ($this->pagesModel->getMenuPages(0) as $section) {
            $section['full_path'] = $this->pagesModel->getFullPath($section['id']);
            $children = $this->pagesModel->getMenuPages($section['id']);
            foreach ($children as &$child) {
                $child['full_path'] = $this->pagesModel->getFullPath($child['id']);
            }
            unset($child);
            $section['children'] = $children;
            $sections[] = $section;
        }

        return view('site/index', [
            'title'       => $settings['SiteName'] ?? 'n-cms',
            'description' => $settings['Description'] ?? '',
            'keywords'    => $settings['Keywords'] ?? '',
            'siteName'    => $settings['SiteName'] ?? 'n-cms',
            'slogan'      => $settings['Slogan'] ?? '',
            'mainText'    => $settings['MainText'] ?? '',
            'sections'    => $sections,
            'menuPages'   => $this->pagesModel->getMenuPages(),
            'activePage'  => 'home',
        ]);
    }

    public function page(...$segments)
    {
        $fullPath = implode('/', $segments);
        $lastSegment = end($segments);

        $page = $this->pagesModel->getByPath($lastSegment);

        if (!$page) {
            throw PageNotFoundException::forPageNotFound();
        }

        $correctPath = $this->pagesModel->getFullPath($page['id']);
        if ($fullPath !== $correctPath) {
            return redirect()->to('/' . $correctPath);
        }

        $settings = $this->settingsModel->getAll();
        $galleryFiles = [];

        if ($page['media'] > 0) {
            $fileModel = new NFileManagerModel();
            $galleryFiles = $fileModel->getFilesByCategory($page['media']);
            foreach ($galleryFiles as &$file) {
                $file['size_formatted'] = format_file_size((int) ($file['file_size'] ?? 0));
                $file['display_name'] = !empty($file['title']) ? $file['title'] : $file['name'];
            }
            unset($file);
        }

        $childrenTree = $this->pagesModel->getTreeForDisplay($page['id']);

        return view('site/page', [
            'title'        => $page['name'] . ' | ' . ($settings['SiteName'] ?? 'n-cms'),
            'description'  => $page['description'] ?: ($settings['Description'] ?? ''),
            'keywords'     => $page['keywords'] ?: ($settings['Keywords'] ?? ''),
            'page'         => $page,
            'childrenTree' => $childrenTree,
            'breadcrumbs'  => $this->getBreadcrumbs($page['id']),
            'galleryFiles' => $galleryFiles,
            'enableSearch' => !empty($galleryFiles),
            'menuPages'    => $this->pagesModel->getMenuPages(),
            'activePage'   => 'page_' . $page['id'],
            'siteName'     => $settings['SiteName'] ?? 'n-cms',
        ]);
    }

    private function getBreadcrumbs(int $id): array
    {
        $breadcrumbs = [];
        $current = $this->pagesModel->find($id);

        while ($current && $current['parent'] > 0) {
            $parent = $this->pagesModel->find($current['parent']);
            if (!$parent) {
                break;
            }
            array_unshift($breadcrumbs, [
                'name' => $parent['name'],
                'url'  => '/' . $this->pagesModel->getFullPath($parent['id']),
            ]);
            $current = $parent;
        }

        return $breadcrumbs;
    }

    public function contacts(): string
    {
        $settings = $this->settingsModel->getAll();
        $siteName = $settings['SiteName'] ?? 'n-cms';

        return view('site/contacts', [
            'title'             => 'Контакты | ' . $siteName,
            'description'       => 'Контактная информация',
            'keywords'          => 'контакты, адрес, телефон, email',
            'siteName'          => $siteName,
            'email'             => $this->contacts['email'],
            'adminEmail'        => $settings['AdminEmail'] ?? '',
            'phone'             => $this->contacts['phone'],
            'address'           => $this->contacts['address'],
            'workSchedule'      => $settings['WorkSchedule'] ?? '',
            'additional_field1' => $settings['additional_field1'] ?? '',
            'menuPages'         => $this->pagesModel->getMenuPages(),
            'activePage'        => 'contacts',
        ]);
    }
}
