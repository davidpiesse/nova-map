[![Total Downloads](https://poser.pugx.org/davidpiesse/nova-map/downloads)](https://packagist.org/packages/davidpiesse/nova-map)
[![Latest Stable Version](https://poser.pugx.org/davidpiesse/nova-map/v/stable)](https://packagist.org/packages/davidpiesse/nova-map)
# Map Field

This map field currently ONLY shows in details view - BUT editing will be coming soon!

![Gif!](https://res.cloudinary.com/davidpiesse/image/upload/v1535397821/ezgif.com-resize_fbxddc.gif)

You can use this Map Field with three different sort of spatial data:
* GeoJSON String property
* Latitude and Longitude properties
* Latitude and Longitude both in a single text field
* Core Laravel Spatial Types 
    * Point
    * LineString
    * Polygon
    * Geometry
    * GeometryCollection
    * MultiPoint
    * MultiLineString
    * MultiPolygon
To use these core types you need to install grimzy/laravel-mysql-spatial
See the section below on setting this up.
This can work with other databases, but YMMV.

* You can set the height of the map in px
* The field is disabled in Index and Form views by default
* This is very much a WIP - please submit issues to GitHub

# Spatial Types
To specify what sort of spatial data you are passing to this field you MUST set the spatialType() for example
```php 
    ->spatialType('Point')
```
These are the valid Spatial Types
* LatLon
* LatLonField (single field)
* GeoJSON
* Point
* LineString
* Polygon
* Geometry
* GeometryCollection
* MultiPoint
* MultiLineString
* MultiPolygon


# Examples

## Point
```php
Map::make('Some Point Field', 'point_field_name')
    ->spatialType('Point'),
```

## Polygon
```php
Map::make('Some Polygon Field', 'polygon_field_name')
    ->spatialType('Polygon'),
```

## GeoJSON 
```php
Map::make('Some GeoJSON Field')
    ->spatialType('GeoJSON')
    ->geojson('geojson_field_name'),
```

## Latitude & Longitude (in seperate fields) 
```php
Map::make('Some Point Location')
    ->spatialType('LatLon')
    ->latitude('latitude_field_name')
    ->longitude('longitude_field_name'),
```

## Latitude & Longitude (in single fields) 
```php
Map::make('Some Point Location', 'coordinate_field_name')
    ->spatialType('LatLonField'),
```

## Set the Height
```php
Map::make('Some Point Field', 'point_field_name')
    ->spatialType('Point')
    ->height('300px'),
```

# Setting up the Laravel Spatial Types
You need to install [grimzy/laravel-mysql-spatial](https://github.com/grimzy/laravel-mysql-spatial) into your main application
```
composer require grimzy/laravel-mysql-spatial
```
Add the SpatialTrait to your Model
```php
use SpatialTrait;
```
You then also need to set any spatial fields you have set in the Model
```php
protected $spatialFields = [
    'geo_point',
    'geo_linestring',
    ...
];
```
Your Model is now ready to process spatial data to Nova

# Planned Development
* Editing capabilities for all Spatial Types
* View Place Field address on a Map
* Remove reliance on grimzy package from accessing core Spatial Types
* Allow all DB spatial fields to be used
* Customize the map futher
    * Tailwind Height classes
    * Customise Geometry Styling
        * Marker Icon
        * Colors, Thicknesses, Opacity
    * Basemap
        * Streets
        * Topo
        * Satellite
    * Navigation Tools (Compass, Zoom In/Out)
* Alternative Map Providers
    * Google Maps
    * Mapbox
    * OpenLayers
