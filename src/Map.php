<?php

namespace Davidpiesse\Map;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;

class Map extends Field
{
    public $component = 'map-field';

    public $showOnUpdate = false;

    public $showOnIndex = false;

    public function height($height = '300px'){
        return $this->withMeta([
            'height' => $height
        ]);
    }

    public function spatialType($type){
        return $this->withMeta([
            'spatialType' => $type
        ]);
    }

    public function latitude($latitude_field){

        $this->attribute = null;

        return $this->withMeta([
            'latitude_field' => $latitude_field
        ]);
    }

    public function longitude($longitude_field){
        $this->attribute = null;

        return $this->withMeta([
            'longitude_field' => $longitude_field
        ]);
    }

    public function geojson($geojson_field){
        $this->attribute = $geojson_field;

        return $this->withMeta([
            'geojson_field' => $geojson_field
        ]);
    }

    // protected function fillAttributeFromRequest(NovaRequest $request,
    //                                             $requestAttribute,
    //                                             $model,
    //                                             $attribute)
    // {
    //     if ($request->exists($requestAttribute)) {
    //         $geometry = Geometry::fromJson($request[$requestAttribute]);
    //         $model->{$attribute} = $geometry;
    //     }
    // }
}
