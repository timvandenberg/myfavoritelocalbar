<template>
  <div>

    <form @submit.prevent="submitForm">
      <input type="hidden" name="_token" :value="token" />

      <div>
        <label for="description">
          Place
        </label>
        <vue-typeahead-bootstrap
          id="place"
          class="mb-4"
          v-model="query"
          :data="places"
          :serializer="item => item.description"
          :screen-reader-text-serializer="item => `Place: ${item.description}`"
          highlightClass="special-highlight-class"
          @hit="getLatLng"
          :minMatchingChars="3"
          placeholder="Search place"
          inputClass="shadow appearance-none border rounded w-full py-2 px-3
            text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
          inputName="place"
          :disabledValues="(selectedplace ? [selectedplace.description] : [])"
          @input="getPlaces"
        >
          <template slot="suggestion" slot-scope="{ data, htmlText }">
            <div class="d-flex align-items-center">
              <span class="ml-4" v-html="htmlText"></span>
            </div>
          </template>
        </vue-typeahead-bootstrap>
      </div>

      <div class="flex items-center justify-end mt-4">
        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
          Create Bar
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import VueTypeaheadBootstrap from 'vue-typeahead-bootstrap';
import {debounce} from 'lodash';

export default {
  components: {
    VueTypeaheadBootstrap
  },
  props: {
    route: {
      type: String,
      required: true
    },
    token: {
      type: String,
      required: true
    }
  },
  data(){
    return {
      fields: {},
      query: '',
      selectedplace: null,
      places: []
    }
  },
  methods: {
    submitForm() {
      axios.post(this.route, this.fields)
        .then(function (response) {

        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getPlaces: debounce(function() {
      this.checkExistingBars()
      this.fields.google_place_description = this.query // WIP deze dus nog koppelen met database en waarsch migrate:fresh nodig
    }, 500),
    checkExistingBars() {
      let _this = this
      axios.post('/search/bar', {
        s: this.query,
      })
        .then(function (response) {
          console.log('checkExistingBars',response)
          if (response.data.length !== 0) {
            _this.places = response.data;
          } else {
            _this.getPlacesGoogleMaps()
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getPlacesGoogleMaps() {
      const service = new google.maps.places.AutocompleteService();
      service.getPlacePredictions({input: this.query}, (predictions, status) => {
        console.log('predictions', predictions)
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
        } else {
          this.places = predictions.map((prediction) => ({description: prediction.description, name: prediction.structured_formatting.main_text, lng: null, lat: null, resultType: 'location', placeId: prediction.place_id}))
        }
      });
    },
    getLatLng (e) {
      this.fields.google_place_id = e.placeId
      this.fields.name = e.name

      const service = new google.maps.Geocoder();
      service.geocode({'placeId': e.placeId}, (response, status2) => {
        console.log('Geocoder', response)
        if (status2 === 'OK') {
          if (response[0])
            this.parseResponse(response)
        } else {
          //
        }
      });
    },
    parseResponse(response) {
      this.fields.lat = response[0].geometry.location.lat()
      this.fields.lng = response[0].geometry.location.lng()
      response[0].address_components.map(el => {
        if (el.types.includes('street_number')) { this.fields.street_nr = el.long_name }
        if (el.types.includes('route')) { this.fields.street = el.long_name }
        if (el.types.includes('locality')) { this.fields.town = el.long_name }
        if (el.types.includes('administrative_area_level_1')) { this.fields.province = el.long_name }
        if (el.types.includes('country')) { this.fields.country = el.long_name }
        if (el.types.includes('postal_code')) { this.fields.postal_code = el.long_name }
      })
    }
  }
}
</script>


<style scoped>

</style>