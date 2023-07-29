<?php

namespace Log1x\Crumb;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class Crumb
{
    /**
     * The breadcrumb items.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $breadcrumb = [];

   /**
    * Initialize the Crumb instance.
    *
    * @param  array $config
    * @return void
    */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->breadcrumb = collect();
    }

    /**
     * Add an item to the breadcrumb collection.
     *
     * @param  string $key
     * @param  string $value
     * @param  int    $id
     * @param  bool   $blog
     * @return $this
     */
    protected function add($key, $value = null, $id = null, $blog = false)
    {
        if (
            ($value === true && empty($blog) || $blog === true) &&
            get_option('show_on_front') === 'page' &&
            ! empty($blog = get_option('page_for_posts')) &&
            ! empty($this->config['blog'])
        ) {
            $this->add(
                $this->config['blog'],
                get_permalink($blog)
            );
        }

        $this->breadcrumb->push([
            'id' => $id,
            'label' => $key,
            'url' => $value,
        ]);

        return $this->breadcrumb;
    }

    /**
     * Build the breadcrumb collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function build()
    {
        if (is_front_page()) {
            return $this->breadcrumb;
        }

        $this->add(
            $this->config['home'],
            home_url()
        );

        if (
            is_home() &&
            ! empty($this->config['blog'])
        ) {
            return $this->add(
                $this->config['blog']
            );
        }

        if (is_page()) {
            $ancestors = collect(
                get_ancestors(get_the_ID(), 'page')
            )->reverse();

            if ($ancestors->isNotEmpty()) {
                $ancestors->each(function ($item) {
                    $this->add(
                        get_the_title($item),
                        get_permalink($item),
                        $item->ID
                    );
                });
            }

            return $this->add(
                get_the_title(),
                null,
                get_the_ID()
            );
        }

        if (is_category()) {
            $category = single_cat_title('', false);

            return $this->add(
                $category,
                null,
                get_cat_ID($category),
                true
            );
        }

        if (is_tag()) {
            $tag = single_tag_title('', false);

            return $this->add(
                $tag,
                null,
                get_term_by('title', $tag, 'post_tag')->term_id,
                true
            );
        }

        if (is_date()) {
            if (is_month()) {
                return $this->add(
                    get_the_date('F Y'),
                    true
                );
            }

            if (is_year()) {
                return $this->add(
                    get_the_date('Y'),
                    true
                );
            }

            return $this->add(
                get_the_date(),
                true
            );
        }

        if (is_tax()) {
            $term = single_term_title('', false);

            return $this->add(
                $term,
                null,
                get_term_by('title', $term, get_query_var('taxonomy'))->term_id
            );
        }

        if (is_search()) {
            return $this->add(
                sprintf($this->config['search'], get_search_query())
            );
        }

        if (is_author()) {
            return $this->add(
                sprintf($this->config['author'], get_the_author()),
                null,
                get_the_author_meta('ID'),
                true
            );
        }

        if (is_post_type_archive()) {
            return $this->add(
                post_type_archive_title('', false)
            );
        }

        if (is_404()) {
            return $this->add(
                $this->config['404']
            );
        }

        if (is_singular('post')) {
            $categories = get_the_category(get_the_ID());

            if (! empty($categories)) {
                $category = array_shift($categories);

                $this->add(
                    $category->name,
                    get_category_link($category),
                    $category->term_id,
                    true
                );

                return $this->add(
                    get_the_title(),
                    null,
                    get_the_ID()
                );
            }

            return $this->add(
                get_the_title(),
                null,
                get_the_ID(),
                true
            );
        }

        $type = get_post_type_object(
            get_post_type()
        );

        if (! empty($type)) {
            $this->add(
                $type->label,
                get_post_type_archive_link($type->name),
                $type->ID
            );
        }

        return $this->add(
            get_the_title(),
            null,
            get_the_ID()
        );
    }
}
