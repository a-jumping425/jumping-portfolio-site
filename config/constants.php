<?php
return [
    'sidebar_menus' => [
        [
            'id' => 'dashboard',
            'name' => 'Dashboard',
            'url' => '/admin_1lkh6x',
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
                    'url' => '/admin_1lkh6x/portfolios',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_edit',
                            'name' => 'Edit Portfolio',
                            'url' => '/admin_1lkh6x/portfolio/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'portfolio_add',
                    'name' => 'Add Portfolio',
                    'url' => '/admin_1lkh6x/portfolio/new',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => []
                ], [
                    'id' => 'portfolio_categories',
                    'name' => 'Categories',
                    'url' => '/admin_1lkh6x/portfolio/categories',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_category_edit',
                            'name' => 'Edit Category',
                            'url' => '/admin_1lkh6x/portfolio/category/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'portfolio_tag',
                    'name' => 'Tags',
                    'url' => '/admin_1lkh6x/portfolio/tags',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_tag_edit',
                            'name' => 'Edit Tag',
                            'url' => '/admin_1lkh6x/portfolio/tag/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'portfolio_technology',
                    'name' => 'Technologies',
                    'url' => '/admin_1lkh6x/portfolio/technologies',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'portfolio_technology_edit',
                            'name' => 'Edit Technology',
                            'url' => '/admin_1lkh6x/portfolio/technology/edit/{id}',
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
                    'url' => '/admin_1lkh6x/users',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => [
                        [
                            'id' => 'user_edit',
                            'name' => 'Edit User',
                            'url' => '/admin_1lkh6x/user/edit/{id}',
                            'icon' => '',
                            'hidden' => 1,
                            'children' => []
                        ]
                    ]
                ], [
                    'id' => 'user_add',
                    'name' => 'Add User',
                    'url' => '/admin_1lkh6x/user/new',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => []
                ], [
                    'id' => 'profile',
                    'name' => 'My profile',
                    'url' => '/admin_1lkh6x/user/profile',
                    'icon' => '',
                    'hidden' => 0,
                    'children' => []
                ]
            ]
        ]
    ],

    'design_levels' => [
        5 => 'Excellent',
        4 => 'Good',
        3 => 'OK',
        2 => 'Poor',
        1 => 'Very Poor'
    ],

    'top_menus' => [
        [
            'id' => 'home',
            'name' => 'Home',
            'url' => '/',
            'icon' => '',
            'hidden' => 0,
            'children' => []
        ], [
            'id' => 'about',
            'name' => 'About Us',
            'url' => '/about-us',
            'icon' => '',
            'hidden' => 0,
            'children' => []
        ], [
            'id' => 'portfolio',
            'name' => 'Portfolio',
            'url' => '/portfolio',
            'icon' => '',
            'hidden' => 0,
            'children' => []
        ], [
            'id' => 'contact',
            'name' => 'Contact',
            'url' => '/contact',
            'icon' => '',
            'hidden' => 0,
            'children' => []
        ]
    ]
];

