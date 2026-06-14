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

        $data = [
            'title'       => $settings['SiteName'] ?? 'n-cms',
            'description' => $settings['Description'] ?? '',
            'keywords'    => $settings['Keywords'] ?? '',
            'siteName'    => $settings['SiteName'] ?? 'n-cms',
            'slogan'      => $settings['Slogan'] ?? '',
            'mainText'    => $settings['MainText'] ?? '',
            'menuPages'   => $this->pagesModel->getMenuPages(),
            'activePage'  => 'home',
            'currentPage' => '',
            'email'       => $this->contacts['email'],
            'phone'       => $this->contacts['phone'],
            'address'     => $this->contacts['address'],
        ];

        return view('site/index', $data);
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
        }

        $data = [
            'title'        => $page['name'] . ' | ' . ($settings['SiteName'] ?? 'n-cms'),
            'description'  => $page['description'] ?: ($settings['Description'] ?? ''),
            'keywords'     => $page['keywords'] ?: ($settings['Keywords'] ?? ''),
            'page'         => $page,
            'childrenTree' => $this->pagesModel->getTreeForDisplay($page['id']),
            'breadcrumbs'  => $this->getBreadcrumbs($page['id']),
            'galleryFiles' => $galleryFiles,
            'menuPages'    => $this->pagesModel->getMenuPages(),
            'activePage'   => 'page_' . $page['id'],
            'currentPage'  => $page['name'],
            'email'        => $this->contacts['email'],
            'phone'        => $this->contacts['phone'],
            'address'      => $this->contacts['address'],
        ];

        return view('site/page', $data);
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

        $data = [
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
            'additional_field2' => $settings['additional_field2'] ?? '',
            'menuPages'         => $this->pagesModel->getMenuPages(),
            'activePage'        => 'contacts',
            'currentPage'       => 'Контакты',
        ];

        return view('site/contacts', $data);
    }
}
