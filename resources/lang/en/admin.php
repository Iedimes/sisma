<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'memo' => [
        'title' => 'Memos',

        'actions' => [
            'index' => 'Memos',
            'create' => 'New Memo',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'odependency_id' => 'Odependency',
            'number_memo' => 'Number memo',
            'ref' => 'Ref',
            'obs' => 'Obs',
            'date_doc' => 'Date doc',
            'date_entry' => 'Date entry',
            'date_exit' => 'Date exit',
            'ddependency_id' => 'Ddependency',
            'admin_user_id' => 'Admin user',
            'state_id' => 'State',
            'type_id' => 'Type',
            
        ],
    ],

    'dependency' => [
        'title' => 'Dependencies',

        'actions' => [
            'index' => 'Dependencies',
            'create' => 'New Dependency',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'ncl' => 'Ncl',
            
        ],
    ],

    'state' => [
        'title' => 'States',

        'actions' => [
            'index' => 'States',
            'create' => 'New State',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'doc-type' => [
        'title' => 'Doc Types',

        'actions' => [
            'index' => 'Doc Types',
            'create' => 'New Doc Type',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'user-cedula' => [
        'title' => 'User Cedulas',

        'actions' => [
            'index' => 'User Cedulas',
            'create' => 'New User Cedula',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'user_id' => 'User',
            'cedula' => 'Cedula',
            
        ],
    ],

    'detail-memo' => [
        'title' => 'Detail Memos',

        'actions' => [
            'index' => 'Detail Memos',
            'create' => 'New Detail Memo',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'memo_id' => 'Memo',
            'odependency_id' => 'Odependency',
            'ddependency_id' => 'Ddependency',
            'date_entry' => 'Date entry',
            'date_exit' => 'Date exit',
            'obs' => 'Obs',
            'state_id' => 'State',
            
        ],
    ],

    'medium' => [
        'title' => 'Media',

        'actions' => [
            'index' => 'Media',
            'create' => 'New Medium',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'model_type' => 'Model type',
            'model_id' => 'Model',
            'uuid' => 'Uuid',
            'collection_name' => 'Collection name',
            'name' => 'Name',
            'file_name' => 'File name',
            'mime_type' => 'Mime type',
            'disk' => 'Disk',
            'conversions_disk' => 'Conversions disk',
            'size' => 'Size',
            'manipulations' => 'Manipulations',
            'custom_properties' => 'Custom properties',
            'generated_conversions' => 'Generated conversions',
            'responsive_images' => 'Responsive images',
            'order_column' => 'Order column',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];