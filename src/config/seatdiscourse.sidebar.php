<?php
/**
 * Created by PhpStorm.
 *  * User: Herpaderp Aldent
 * Date: 09.06.2018
 * Time: 18:56
 */

return [
    'seatdiscorse' => [
        'name' => 'SeAT Discourse',
        'icon' => 'fa-comments-o',
        'route_segment' => 'sso',
        'entries' => [
            [
                'name' => 'Forum',
                'icon' => 'fa-commenting-o',
                'route' => 'sso.forum'
            ],
            [
                'name' => 'About',
                'icon' => 'fa-info-circle',
                'route' => 'seatdiscourse.about'
            ]
        ]

    ]
];