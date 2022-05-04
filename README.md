# Laravel Nova Sortable Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pixelcreation/nova-field-sortable.svg?style=flat-square)](https://packagist.org/packages/pixelcreation/nova-field-sortable)
[![Total Downloads](https://img.shields.io/packagist/dt/pixelcreation/nova-field-sortable.svg?style=flat-square)](https://packagist.org/packages/pixelcreation/nova-field-sortable)

## Description

This field adds reordering functionality to your resource's index using the awesome [eloquent-sortable](https://github.com/spatie/eloquent-sortable) package by the great people of [Spatie](https://spatie.be).

This package is a fork of the original package by [Naxon/nova-field-sortable](https://github.com/Naxon/nova-field-sortable).

![screenshot](https://github.com/PixelCreation/nova-field-sortable/raw/master/docs/screenshot.png)

## Requirements

* Nova 4
* [spatie/eloquent-sortable](https://github.com/spatie/eloquent-sortable) (If not already installed, this package will install if for you and all you have to do is follow the [installation](https://github.com/spatie/eloquent-sortable#installation) instructions).

## Installation

This package can be installed through Composer.
```bash
composer require pixelcreation/nova-field-sortable
```

## Usage

1. Follow the [usage instructions](https://github.com/spatie/eloquent-sortable#usage) on the eloquent-sortable repository to make your model sortable.
2. Use the `PixelCreation\NovaFieldSortable\Concerns\SortsIndexEntries` trait in your Nova Resource.
3. Add a public static property called `$defaultSortField` to your resource, containing your sorting column (I recomment adding it in your main `app/Nova/Resource.php` file).
4. Add the `PixelCreation\NovaFieldSortable\Sortable` field to your Nova Resource `fields` method, using a label and your primary key column.

### Example

```php
<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use PixelCreation\NovaFieldSortable\Concerns\SortsIndexEntries;
use PixelCreation\NovaFieldSortable\Sortable;

class Page extends Resource
{
    use SortsIndexEntries;
    
    public static $defaultSortField = 'sort_order';
    
    /**
     * Get the fields displayed by the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            
            Text::make('Title'),
            
            Sortable::make('Order', 'id')
                ->onlyOnIndex(),
        ];
    }
}

```

## Credits

* [Spatie](https://spatie.be)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
