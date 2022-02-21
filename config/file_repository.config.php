<?php

return array(
    'repositories' => (object) array(
        'test' => (object) array(
            'class' => \PHWolfCMS\Kernel\Modules\FileRepository\TestFileRepository::class,
            'mime_types' => array(
                'text/html',
                'text/plain'
            ),
            'max_file_size' => 1000 # байт
        )
    ),

    'repo_dir' => 'storage/fileRepositories/{REPO_NAME}/', # {REPO_NAME} - будет заменено на имя репозитория
);