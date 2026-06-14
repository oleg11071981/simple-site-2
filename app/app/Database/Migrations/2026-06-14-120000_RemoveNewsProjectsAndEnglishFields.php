<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Удаляет таблицы новостей/проектов и поля английской локализации.
 */
class RemoveNewsProjectsAndEnglishFields extends Migration
{
    public function up()
    {
        $tables = [
            'n_project_events',
            'n_projects',
            'n_news_articles',
            'n_news_categories',
        ];

        foreach ($tables as $table) {
            if ($this->db->tableExists($table)) {
                $this->forge->dropTable($table, true);
            }
        }

        if ($this->db->tableExists('n_site')) {
            $siteColumns = ['name_en', 'more_info_en', 'anons_text_en', 'keywords_en', 'description_en', 'project'];
            $dropSite = [];
            foreach ($siteColumns as $column) {
                if ($this->db->fieldExists($column, 'n_site')) {
                    $dropSite[] = $column;
                }
            }
            if ($dropSite !== []) {
                $this->forge->dropColumn('n_site', $dropSite);
            }
        }

        if ($this->db->tableExists('n_file_manager') && $this->db->fieldExists('title_en', 'n_file_manager')) {
            $this->forge->dropColumn('n_file_manager', 'title_en');
        }

        if ($this->db->tableExists('n_siteconfig')) {
            $this->db->table('n_siteconfig')
                ->whereIn('parameter', ['SiteName_en', 'Slogan_en', 'MainText_en', 'Keywords_en', 'Description_en'])
                ->delete();
        }
    }

    public function down()
    {
        // Откат не восстанавливает удалённые данные.
    }
}
