<?php
return array(
    'validators' => (object) array(
        'password' => (object) array(
            'class' => \PHWolfCMS\Kernel\Modules\Validator\PasswordValidator::class,
            'validators' => (object) array(
                'min_length' => 8,
                'max_length' => 100
            )
        )
    ),

);