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
            'id' => 'portfolio',
            'name' => 'Portfolio',
            'url' => '',
            'icon' => 'icon-notebook',
            'hidden' => 0,
            'children' => [
                [
                    'id' => 'portfolio_all',
                    'name' => 'All Portfolios',
                    'url' => '/portfolio',
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
                    'url' => '/portfolio/category',
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
                    'id' => 'portfolio_skill',
                    'name' => 'Skills',
                    'url' => '/portfolio/skill',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_skill_edit',
                            'name' => 'Edit Skill',
                            'url' => '/portfolio/skill/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ]
            ]
        ], [
            'id' => 'user',
            'name' => 'Users',
            'url' => '',
            'icon' => 'icon-user',
            'hidden' => 0,
            'children' => [
                [
                    'id' => 'user_all',
                    'name' => 'All Users',
                    'url' => '/user',
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
                ]
            ]
        ]
    ]
];

