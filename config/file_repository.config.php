<?php

return array(
    'repositories' => (object) array(
        'test' => \PHWolfCMS\Kernel\FileRepositories\TestFileRepository::class
    ),

    'repo_dir' => 'storage/fileRepositories/{REPO_NAME}/', # {REPO_NAME} - будет заменено на имя репозитория
    'upload_to' => '{USERID_HASH_MD5}/{FILE_HASH_NAME}.{EXT}' # {USERID_HASH_MD5} - md5 id пользователя, если не аутентифицирован, то 0; {FILE_HASH_NAME} = md5(filename . microtime()); {EXT} - расширение файла
);