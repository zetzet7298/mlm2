<?php

return array(
    // Documentation menu
    'documentation' => array(
        // Getting Started
        array(
            'heading' => 'Getting Started',
        ),

        // Overview
        array(
            'title' => 'Overview',
            'path'  => 'documentation/getting-started/overview',
        ),

        // Build
        array(
            'title' => 'Build',
            'path'  => 'documentation/getting-started/build',
        ),

        array(
            'title'      => 'Multi-demo',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/getting-started/multi-demo/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Build',
                        'path'   => 'documentation/getting-started/multi-demo/build',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // File Structure
        array(
            'title' => 'File Structure',
            'path'  => 'documentation/getting-started/file-structure',
        ),

        // Customization
        array(
            'title'      => 'Customization',
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'classes'    => array('item' => 'menu-accordion'),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'SASS',
                        'path'   => 'documentation/getting-started/customization/sass',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Javascript',
                        'path'   => 'documentation/getting-started/customization/javascript',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Dark skin
        array(
            'title' => 'Dark Mode Version',
            'path'  => 'documentation/getting-started/dark-mode',
        ),

        // RTL
        array(
            'title' => 'RTL Version',
            'path'  => 'documentation/getting-started/rtl',
        ),

        // Troubleshoot
        array(
            'title' => 'Troubleshoot',
            'path'  => 'documentation/getting-started/troubleshoot',
        ),

        // Changelog
        array(
            'title'            => 'Changelog <span class="badge badge-changelog badge-light-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2">v' . theme()->getVersion() . '</span>',
            'breadcrumb-title' => 'Changelog',
            'path'             => 'documentation/getting-started/changelog',
        ),

        // References
        array(
            'title' => 'References',
            'path'  => 'documentation/getting-started/references',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // Configuration
        array(
            'heading' => 'Configuration',
        ),

        // General
        array(
            'title' => 'General',
            'path'  => 'documentation/configuration/general',
        ),

        // Menu
        array(
            'title' => 'Menu',
            'path'  => 'documentation/configuration/menu',
        ),

        // Page
        array(
            'title' => 'Page',
            'path'  => 'documentation/configuration/page',
        ),

        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // General
        array(
            'heading' => 'General',
        ),

        // DataTables
        array(
            'title'      => 'DataTables',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array("data-kt-menu-trigger" => "click"),
            'sub'        => array(
                'class' => 'menu-sub-accordion',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'documentation/general/datatables/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),

        // Remove demos
        array(
            'title' => 'Remove Demos',
            'path'  => 'documentation/general/remove-demos',
        ),


        // Separator
        array(
            'custom' => '<div class="h-30px"></div>',
        ),

        // HTML Theme
        array(
            'heading' => 'HTML Theme',
        ),

        array(
            'title' => 'Components',
            'path'  => '//preview.keenthemes.com/metronic8/demo1/documentation/base/utilities.html',
        ),

        array(
            'title' => 'Documentation',
            'path'  => '//preview.keenthemes.com/metronic8/demo1/documentation/getting-started.html',
        ),
    ),

    // Main menu
    'main'          => array(
        //// Dashboard
        array(
            'title' => 'Dashboard',
            'path'  => 'index',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        //// Modules
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Modules</span>',
        ),

        // Account
        array(
            'role' => 'admin|member',
            'title'      => 'My Account',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
            'role' => 'admin|member',
                        'title'  => 'Overview',
                        'path'   => 'account/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'  => 'Settings',
                        'path'   => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'      => 'Security',
                        'path'       => 'account/security',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        // 'attributes' => array(
                        //     'link' => array(
                        //         "title"             => "Coming soon",
                        //         "data-bs-toggle"    => "tooltip",
                        //         "data-bs-trigger"   => "hover",
                        //         "data-bs-dismiss"   => "click",
                        //         "data-bs-placement" => "right",
                        //     ),
                        // ),
                    ),
                ),
            ),
        ),

        // System
        // array(
        //     'title'      => 'System',
        //     'icon'       => array(
        //         'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen025.svg", "svg-icon-2"),
        //         'font' => '<i class="bi bi-layers fs-3"></i>',
        //     ),
        //     'classes'    => array('item' => 'menu-accordion'),
        //     'attributes' => array(
        //         "data-kt-menu-trigger" => "click",
        //     ),
        //     'sub'        => array(
        //         'class' => 'menu-sub-accordion menu-active-bg',
        //         'items' => array(
        //             array(
        //                 'title'      => 'Settings',
        //                 'path'       => '#',
        //                 'bullet'     => '<span class="bullet bullet-dot"></span>',
        //                 'attributes' => array(
        //                     'link' => array(
        //                         "title"             => "Coming soon",
        //                         "data-bs-toggle"    => "tooltip",
        //                         "data-bs-trigger"   => "hover",
        //                         "data-bs-dismiss"   => "click",
        //                         "data-bs-placement" => "right",
        //                     ),
        //                 ),
        //             ),
        //             array(
        //                 'title'  => 'Audit Log',
        //                 'path'   => 'log/audit',
        //                 'bullet' => '<span class="bullet bullet-dot"></span>',
        //             ),
        //             array(
        //                 'title'  => 'System Log',
        //                 'path'   => 'log/system',
        //                 'bullet' => '<span class="bullet bullet-dot"></span>',
        //             ),
        //         ),
        //     ),
        // ),

        // Separator
        array(
            'content' => '<div class="separator mx-1 my-4"></div>',
        ),

        // Changelog
        array(
            'title' => 'Changelog v' . theme()->getVersion(),
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen005.svg", "svg-icon-2"),
            'path'  => 'documentation/getting-started/changelog',
        ),
    ),

    // Horizontal menu
    'horizontal'    => array(
        // Dashboard
        array(
            'title'   => 'Dashboard',
            'path'    => 'index',
            'classes' => array('item' => 'me-lg-1'),
        ),

        // Resources
        // array(
        //     'title'      => 'Resources',
        //     'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
        //     'attributes' => array(
        //         'data-kt-menu-trigger'   => "click",
        //         'data-kt-menu-placement' => "bottom-start",
        //     ),
        //     'sub'        => array(
        //         'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
        //         'items' => array(
        //             // Documentation
        //             array(
        //                 'title' => 'Documentation',
        //                 'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/abstract/abs027.svg", "svg-icon-2"),
        //                 'path'  => 'documentation/getting-started/overview',
        //             ),

        //             // Changelog
        //             array(
        //                 'title' => 'Changelog v'.theme()->getVersion(),
        //                 'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen005.svg", "svg-icon-2"),
        //                 'path'  => 'documentation/getting-started/changelog',
        //             ),
        //         ),
        //     ),
        // ),

        // Account
        array(
            'role' => 'user',
            'title'      => 'My Account',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
            'role' => 'user',
                        'title'  => 'Overview',
                        'path'   => 'account/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'user',
                        'title'  => 'Settings',
                        'path'   => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'user',
                        'title'      => 'Password Management',
                        'path'       => 'account/security',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        // 'attributes' => array(
                        //     'link' => array(
                        //         "title"             => "Coming soon",
                        //         "data-bs-toggle"    => "tooltip",
                        //         "data-bs-trigger"   => "hover",
                        //         "data-bs-dismiss"   => "click",
                        //         "data-bs-placement" => "right",
                        //     ),
                        // ),
                    ),
                ),
            ),
        ),

        // My Team
        array(
            'role' => 'admin|member',
            'title'      => 'My Team',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
            '           role' => 'admin|member',
                        'title'  => 'System Tree',
                        'path'   => 'team/system-tree',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'role' => 'admin',
                        'title'  => 'Free Introduction List',
                        'path'   => 'team/users',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'role' => 'admin',
                        'title'      => 'Fee Introduction List',
                        'path'       => 'team/fee-users',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        // 'attributes' => array(
                        //     'link' => array(
                        //         "title"             => "Coming soon",
                        //         "data-bs-toggle"    => "tooltip",
                        //         "data-bs-trigger"   => "hover",
                        //         "data-bs-dismiss"   => "click",
                        //         "data-bs-placement" => "right",
                        //     ),
                        // ),
                    ),
                ),
            )
        ),
        // My Wallet
        array(
            'role' => 'user',
            'title'      => 'My Wallet',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
            'role' => 'admin|member',
                        'title'  => 'Upgrade',
                        'path'   => 'wallet/upgrade',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'  => 'Income History',
                        'path'   => 'wallet/income-history',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'      => 'Transfer',
                        'path'       => 'wallet/transfer-history',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'      => 'Cash Withdrawal History',
                        'path'       => 'wallet/withdrawal-history',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                    ),

                ),
            )
        ),
        // artificial intelligence
        array(
            'role' => 'admin|member',
            'title'      => 'Artificial Intelligence',
            'path'   => '#',
            'attributes' => array(
                'link' => array(
                    "title"             => "Coming soon",
                    "data-bs-toggle"    => "tooltip",
                    "data-bs-trigger"   => "hover",
                    "data-bs-dismiss"   => "click",
                    "data-bs-placement" => "right",
                ),
            ),
        ),
        // gift
        array(
            'role' => 'admin|member',
            'title'      => 'Gift',
            'path'       => 'gift',
            // 'attributes' => array(
            //     'link' => array(
            //         "title"             => "Coming soon",
            //         "data-bs-toggle"    => "tooltip",
            //         "data-bs-trigger"   => "hover",
            //         "data-bs-dismiss"   => "click",
            //         "data-bs-placement" => "right",
            //     ),
            // ),
        ),
        // gift
        array(
            'role' => 'admin|member',
            'title'      => 'Product',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
            'role' => 'admin|member',
                    array(
                        'title'  => 'Product List',
                        'path'   => 'management/products',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'  => 'Post Product',
                        'path'   => 'management/products/create',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'  => 'Category List',
                        'path'   => 'management/category',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
            'role' => 'admin|member',
                        'title'  => 'Add Category',
                        'path'   => 'management/category/create',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            )
        ),
        // gift
        // array(
        //     'role' => 'admin',
        //     'title'      => 'Order',
        //     'path'       => 'management/order',
        // ),
        array(
        'role' => 'admin|member',
            'title'  => 'Customer Gratitude',
            'path'   => 'customer/gratitude',
        ),
        // // System
        // array(
        //     'title'      => 'System',
        //     'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
        //     'attributes' => array(
        //         'data-kt-menu-trigger'   => "click",
        //         'data-kt-menu-placement' => "bottom-start",
        //     ),
        //     'sub'        => array(
        //         'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
        //         'items' => array(
                    // array(
                    //     'title'      => 'Settings',
                    //     'path'       => '#',
                    //     'bullet'     => '<span class="bullet bullet-dot"></span>',
                    //     'attributes' => array(
                    //         'link' => array(
                    //             "title"             => "Coming soon",
                    //             "data-bs-toggle"    => "tooltip",
                    //             "data-bs-trigger"   => "hover",
                    //             "data-bs-dismiss"   => "click",
                    //             "data-bs-placement" => "right",
                    //         ),
                    //     ),
                    // ),
        //             array(
        //                 'title'  => 'Audit Log',
        //                 'path'   => 'log/audit',
        //                 'bullet' => '<span class="bullet bullet-dot"></span>',
        //             ),
        //             array(
        //                 'title'  => 'System Log',
        //                 'path'   => 'log/system',
        //                 'bullet' => '<span class="bullet bullet-dot"></span>',
        //             ),
        //         ),
        //     ),
        // ),
    ),
);
