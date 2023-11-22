<?php

return [
    'columns' => [
        // [
        //     'title' => 'Title',
        //     'dataIndex' => 'title',
        //     'shorter' => true,
        // ],
        // [
        //     'title' => 'Description',
        //     'dataIndex' => 'description',
        // ],
        // [
        //     'title' => 'Status',
        //     'dataIndex' => 'status',
        // ],
        // // [
        // //     'name' => 'Category',
        // //     'dataIndex' => 'category_name',
        // // ],
        // [
        //     'title' => 'Action',
        //     'key' => 'action',
        //     'renderOptions' => [
        //         'action' => [
        //             'type' => 'button',
        //             'text' => 'Delete',
        //             'icon' => 'Delete',
        //             'style' => [
        //                 'color' => 'red',
        //                 'background' => 'lightred',
        //             ],
        //             'onClick' => [
        //                 'type' => 'delete',
        //                 'endpoint' => 'https://jsonplaceholder.typicode.com/posts/delete/{ID}',
        //             ],
        //         ],
        //     ],
        // ],
        // [
        //     'title' => '...',
        //     'key' => '...',
        //     'renderOptions' => [
        //         'action' => [
        //             'type' => 'button',
        //             'icon' => 'Delete',
        //             'menuItems' => [
        //                 [
        //                     'text' => 'Delete',
        //                     'onClick' => [
        //                         'type' => 'delete',
        //                         'endpoint' => 'https://jsonplaceholder.typicode.com/posts/delete/{ID}',
        //                     ],
        //                 ],
        //                 [
        //                     'text' => 'Edit',
        //                     'onClick' => [
        //                         'type' => 'edit',
        //                         'targetComponent' => 'Form',
        //                         'props' => [
        //                             'id' => 'dataIndexofID',
        //                             'email' => 'user_email', // dataIndexofEmail
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
        [
            "title" => "Name",
            "dataIndex" => "name",
            "sorter" => true
        ],
        [
            "title" => "Job Title",
            "dataIndex" => "job_title",
        ],
        [
            "title" => "Line Manager",
            "dataIndex" => "line_manager",
        ],
        [
            "title" => "Department",
            "dataIndex" => "department",
            "editable" => false
        ],
        [
            "title" => "Office",
            "dataIndex" => "Office",
        ],
        [
            "title" => "Employee Status",
            "dataIndex" => "employee_status",
        ],
        [
            "title" => "Account",
            "dataIndex" => "account",
        ],
    ],
    'props' => [
        'cellBorder' => false,
        'style' => [
            'backgroundColor' => 'white',
        ],
    ],
];
