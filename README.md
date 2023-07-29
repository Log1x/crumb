# Crumb

![Latest Stable Version](https://img.shields.io/packagist/v/log1x/crumb?style=flat-square)
![Build Status](https://img.shields.io/github/actions/workflow/status/log1x/crumb/main.yml?branch=master&style=flat-square)
![Total Downloads](https://img.shields.io/packagist/dt/log1x/crumb?style=flat-square)

A simple breadcrumb package for Sage 10.

## Requirements

- [Sage](https://github.com/roots/sage) >= 10.0
- [PHP](https://secure.php.net/manual/en/install.php) >= 7.3
- [Composer](https://getcomposer.org/download/)

## Installation

Install via Composer:

```bash
$ composer require log1x/crumb
```

## Usage

Publish the breadcrumb configuration file using Acorn:

```sh
$ wp acorn vendor:publish --provider="Log1x\Crumb\CrumbServiceProvider"
```

### Example

```php
# app/View/Components/Breadcrumb.php

<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;
use Log1x\Crumb\Facades\Crumb;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * The breadcrumb items.
     *
     * @return string
     */
    public function items()
    {
        return Crumb::build()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.breadcrumb');
    }
}
```

```php
# views/components/breadcrumb.blade.php

@if (! empty($items))
  <nav
    aria-label="Breadcrumb"
    class="flex items-center py-2 -mx-2 leading-none"
    vocab="https://schema.org/"
    typeof="BreadcrumbList"
  >
    @foreach ($items as $item)
      @if (empty($item['url']))
        <span class="p-2 font-medium cursor-default">
          {{ $item['label'] }}
        </span>
      @else
        <span class="p-2" property="itemListElement" typeof="ListItem">
          <a
            property="item"
            typeof="WebPage"
            title="Go to {!! $item['label'] !!}."
            href="{{ $item['url'] }}"
            class="hover:text-indigo-500"
          >
            <span property="name">
              @if ($loop->first)
                <svg
                  class="flex-shrink-0 w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>

                <span class="sr-only">{!! $item['label'] !!}</span>
              @else
                {!! $item['label'] !!}
              @endif
            </span>
          </a>

          <meta property="position" content="{{ $loop->iteration }}">
        </span>

        @if (!$loop->last)
          <svg class="flex-shrink-0 w-5 h-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        @endif
      @endif
    @endforeach
  </nav>
@endif
```

## Bug Reports

If you discover a bug in Crumb, please [open an issue](https://github.com/log1x/crumb/issues).

## Contributing

Contributing whether it be through PRs, reporting an issue, or suggesting an idea is encouraged and appreciated.

## License

Crumb is provided under the [MIT License](https://github.com/log1x/crumb/blob/master/LICENSE.md).
