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

    public $height = '300px';

    public $zoom = 8;

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta([
            'height' => $this->height,
            'zoom' => $this->zoom,
        ]);
    }

    public function height($height){
        if($height) {
            return $this->withMeta([
                'height' => $height
            ]);
        }
    }

    public function zoom($zoom){
        if($zoom) {
            return $this->withMeta([
                'zoom' => $zoom
            ]);
        }
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

    public function resolveAttribute($resource, $attribute = null){
        switch($this->meta['spatialType']){
            case 'LatLon':
                return [
                    'lat' => $resource->{$this->meta['latitude_field']},
                    'lon' => $resource->{$this->meta['longitude_field']},
                ];
                break;
            case 'LatLonField':
                $parts = collect(explode(',',$resource->{$attribute}))->map(function($item){
                    return trim($item);
                });

                return [
                    'lat' => $parts[0],
                    'lon' => $parts[1],
                ];
                break;
            case 'GeoJSON':
                return $resource->{$attribute};
                break;
            default:
                return $resource->{$attribute};
                break;
        }
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
