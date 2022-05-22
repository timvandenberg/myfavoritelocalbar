<template>
  <div>
    <div id="map" class="mt-5"/>
  </div>
</template>

<script>
export default {
  name: 'Maps',
  data() {
    return {
      center: {
        lat: 51.093048,
        lng: 6.842120
      },
      markers: [
        {
          position: {
            lat: 51.093048, lng: 6.842120
          },
        }
      ]
    }
  },
  mounted() {
    const mapDiv = document.getElementById('map');

    if (mapDiv) {
      this.map = new google.maps.Map(mapDiv, {
        disableDefaultUI: true,
        mapTypeControl: false,
        scaleControl: true,
        zoomControl: true,
        center: {lat: 52, lng: 6},
        zoom: 8,
      });
    }
  }
}
</script>

<style scoped>
#map {
  width: 100%;
  height: 400px;
}
</style>