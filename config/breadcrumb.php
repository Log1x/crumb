<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Home
    |--------------------------------------------------------------------------
    |
    | This option controls the label used when displaying the homepage on the
    | breadcrumb.
    |
    */

    'home' => get_bloginfo('name', 'display'),

    /*
    |--------------------------------------------------------------------------
    | Blog
    |--------------------------------------------------------------------------
    |
    | This option controls the label used when displaying the posts page on the
    | breadcrumb. If a posts page is not configured, this option can be
    | disregarded.
    |
    | If a posts page is configured but you would not like it shown in the
    | breadcrumb, you may explicitly set this option to `false`.
    |
    */

    'blog' => get_the_title(
        get_option('page_for_posts')
    ),

    /*
    |--------------------------------------------------------------------------
    | Author
    |--------------------------------------------------------------------------
    |
    | This option controls the label used when displaying the author archive
    | page on the breadcrumb.
    |
    | The `%s` identifier represents the authors configured display name.
    |
    */

    'author' => __('Posts by %s', 'sage'),

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | This option controls the label used when displaying the search results
    | page on the breadcrumb.
    |
    | The `%s` identifier represents the current search query.
    |
    */

    'search' => __('Search results for "%s"', 'sage'),

    /*
    |--------------------------------------------------------------------------
    | 404
    |--------------------------------------------------------------------------
    |
    | This option controls the label used when displaying the 404 error page
    | on the breadcrumb.
    |
    */

    '404' => __('Page not found', 'sage'),
];
