<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NSiteconfigModel;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class SettingsController extends BaseController
{
    protected NSiteconfigModel $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new NSiteconfigModel();
    }

    public function index(): string
    {
        $data = [
            'title'      => 'Настройки сайта',
            'activeMenu' => 'settings',
            'settings'   => $this->settingsModel->getAll(),
        ];

        return view('admin/settings/index', $data);
    }

    /**
     * @throws ReflectionException
     */
    public function save(): RedirectResponse
    {
        foreach ($this->request->getPost() as $key => $value) {
            if ($key === 'csrf_test_name') {
                continue;
            }
            $this->settingsModel->saveValue($key, $value);
        }

        $this->settingsModel->clearCache();

        log_message('info', '[SETTINGS] Пользователь "{login}" (ID: {id}) обновил настройки сайта', [
            'login' => session()->get('user_login'),
            'id'    => session()->get('user_id'),
        ]);

        return redirect()->to('/admin-panel/settings')
            ->with('success', 'Настройки сохранены');
    }
}
