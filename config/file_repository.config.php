<?php

return array(
    'repositories' => (object) array(
        'skin' => (object) array(
            'class' => \PHWolfCMS\Kernel\Modules\FileRepository\SkinFileRepository::class,
            'mime_types' => array(
                'image/jpeg',
                'image/png'
            ),
            'max_file_size' => 4096, # байт
            'require_auth' => true
        ),
        'cloak' => (object) array(
            'class' => \PHWolfCMS\Kernel\Modules\FileRepository\CloakFileRepository::class,
            'mime_types' => array(
                'image/jpeg',
                'image/png'
            ),
            'max_file_size' => 4096, # байт
            'require_auth' => true
        ),
    ),

    'repo_dir' => 'storage/fileRepositories/{REPO_NAME}/', # {REPO_NAME} - будет заменено на имя репозитория
);