<?php
return [
    'sidebar_menus' => [
        [
            'id' => 'dashboard',
            'name' => 'Dashboard',
            'url' => '/',
            'icon' => 'icon-home',
            'hidden' => 0,
            'children' => []
        ], [
            'id' => 'portfolios',
            'name' => 'Portfolios',
            'url' => '',
            'icon' => 'icon-notebook',
            'hidden' => 0,
            'children' => [
                [
                    'id' => 'portfolio_all',
                    'name' => 'All Portfolios',
                    'url' => '/portfolios',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_edit',
                            'name' => 'Edit Portfolio',
                            'url' => '/portfolio/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'portfolio_add',
                    'name' => 'Add Portfolio',
                    'url' => '/portfolio/new',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => []
                ], [
                    'id' => 'portfolio_categories',
                    'name' => 'Categories',
                    'url' => '/portfolio/categories',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_category_edit',
                            'name' => 'Edit Category',
                            'url' => '/portfolio/category/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'portfolio_tag',
                    'name' => 'Tags',
                    'url' => '/portfolio/tags',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_tag_edit',
                            'name' => 'Edit Tag',
                            'url' => '/portfolio/tag/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ]
            ]
        ], [
            'id' => 'users',
            'name' => 'Users',
            'url' => '',
            'icon' => 'icon-user',
            'hidden' => 0,
            'children' => [
                [
                    'id' => 'user_all',
                    'name' => 'All Users',
                    'url' => '/users',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'user_edit',
                            'name' => 'Edit User',
                            'url' => '/user/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'user_add',
                    'name' => 'Add User',
                    'url' => '/user/new',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => []
                ], [
                    'id' => 'profile',
                    'name' => 'My profile',
                    'url' => '/user/profile',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => []
                ]
            ]
        ]
    ]
];

