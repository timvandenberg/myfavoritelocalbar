<template>
  <div>
    <div class="block text-gray-700 text-sm font-bold mb-2">
      Place
    </div>

    <vue-typeahead-bootstrap
        class="mb-4"
        v-model="query"
        :data="places"
        :serializer="item => item.name"
        :screen-reader-text-serializer="item => `Place: ${item.name}`"
        highlightClass="special-highlight-class"
        @hit="selectedplace = $event"
        :minMatchingChars="3"
        placeholder="Search place"
        inputClass="shadow appearance-none border rounded w-full py-2 px-3
          text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
        inputName="place"
        :disabledValues="(selectedplace ? [selectedplace.name] : [])"
        @input="getPlaces"
    >
      <template slot="suggestion" slot-scope="{ data, htmlText }">
        <div class="d-flex align-items-center">
          <span class="ml-4" v-html="htmlText"></span>
        </div>
      </template>
    </vue-typeahead-bootstrap>
  </div>
</template>

<script>
import VueTypeaheadBootstrap from 'vue-typeahead-bootstrap';
import {debounce} from 'lodash';

export default {
  components: {
    VueTypeaheadBootstrap
  },
  data(){
    return {
      query: '',
      selectedplace: null,
      places: []
    }
  },
  methods: {
    getPlaces: debounce(function() {
      let _this = this
      axios.post('/search/place', {
          s: this.query,
        })
        .then(function (response) {
          console.log('response', response)
          _this.places = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }, 500),
    getPlacesGoogleMaps: debounce(function() {
      const service = new google.maps.places.AutocompleteService();
      service.getPlacePredictions({input: this.query, types: ['(cities)']}, (predictions, status) => {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
        } else {
          this.places = predictions.map((prediction) => ({name: prediction.description, lng: null, lat: null, resultType: 'location', placeId: prediction.place_id}))
        }
      });
    }, 500)
  }
}
</script>


<style scoped>

</style>