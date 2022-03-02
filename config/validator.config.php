<?php
return array(
    'validators' => (object) array(
        'password' => (object) array(
            'validators' => (object) array(
                'min_length' => 8,
                'max_length' => 255,
                'regexp' => '/(?=.*[0-9])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]+/'
            )
        ),
        'login' => (object) array(
            'validators' => (object) array(
                'min_length' => 3,
                'max_length' => 30,
                'regexp' => '/^(?=.*[a-zA-Z])[a-zA-Z0-9_]+$/'
            )
        ),
        'email' => (object) array(
            'validators' => (object) array(
                'email' => true
            )
        ),
    ),

);
