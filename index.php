<?php

require_once 'vendor/autoload.php';

use Medoo\Medoo;

$medoo = new Medoo(
    [
        'database_type' => 'mysql',
        'database_name' => 'webspace',
        'server' => 'localhost',
        'username' => 'webspace',
        'password' => 'p33#b3cG',
        'charset' => 'utf8',
        'port' => 3306
    ]
);

if (isset($_GET['method'])) {
    switch ($_GET['method']) {
        case 'getProjects':
            $project = $medoo->select('github_repos', 
            [
                '[>]github_user' => ['owner_github_user_id' => 'github_user_id']
            ],[
                'github_repos.github_id',
                'github_repos.name',
                'github_repos.full_name',
                'github_repos.url',
                'github_repos.language',
                'github_repos.pushed_at',
                'github_repos.updated_at',
                'github_repos.created_at',
                'github_repos.description',
                'github_repos.languages_url',
                'github_repos.stars',
                'github_repos.watchers',
                'github_user.username'
            ],[
                'github_repos.show_on_homepage' => 1
            ]);


            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: access");
            header("Access-Control-Allow-Methods: POST");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            echo json_encode($project, true);
            die();

            break;
    }
}