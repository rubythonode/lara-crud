<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.01.2018
 * Time: 16:06
 */
namespace Trafik8787\LaraCrud\Console\Commands;


class CreateMigrationExample extends Installer {



    public function showInfo()
    {
        $this->command->line('Run migration: <info>✔</info>');
    }

    public function install()
    {

        $this->command->call('lara:node', ['name' => 'ArticleExample', '--tableExample' => 'example_articles']);
        $this->command->call('migrate', ['--path' => 'vendor/trafik8787/lara-crud/src/Console/Commands/Example/migrations']);
        $this->command->call('migrate');
        $this->command->call('db:seed', ['--class' => 'Trafik8787\LaraCrud\Seeder\ArticleTableExampleSeeder']);
    }


    public function installed()
    {
        return false;
    }


    protected function getFilePath()
    {
        return app_path('Providers/LaraCrudProvider.php');
    }


}