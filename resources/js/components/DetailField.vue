<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <slot>
                <h4 class="font-normal text-80">
                    {{ field.name }}
                </h4>
            </slot>
        </div>
        <div class="w-3/4 py-4">
            <div class="rounded flex flex-col" :style="'height: ' + field.height">
                <map-detail
                    :type="field.spatialType"
                    :zoom="field.zoom"
                    :value="field.value"
                    :latitude_field="field.latitude_field"
                    :longitude_field="field.longitude_field"
                    :geojson_field="field.geojson_field"
                >
                </map-detail>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data(){
        return {
            show: false
        }
    }
}
</script>
