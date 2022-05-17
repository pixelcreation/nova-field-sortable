<?php

namespace PixelCreation\NovaFieldSortable;

use Laravel\Nova\Fields\Field;

class Sortable extends Field
{
    /**
     * Create a new field.
     *
     * @param string $name
     * @param null $attribute
     * @param callable|null $resolveCallback
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->textAlign(Field::CENTER_ALIGN);
    }

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-field-sortable';

    /**
     * Indicates if the element should be shown on the creation view.
     *
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):bool)|bool
     */
    public $showOnCreation = false;

    /**
     * Indicates if the element should be shown on the update view.
     *
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):bool)|bool
     */
    public $showOnUpdate = false;
}
