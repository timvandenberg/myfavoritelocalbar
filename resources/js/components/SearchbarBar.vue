<template>
  <div>
    <div class="block text-gray-700 text-sm font-bold mb-2">
      Local Bar
    </div>

    <vue-typeahead-bootstrap
        class="mb-4"
        v-model="query"
        :data="bars"
        :serializer="item => item.name"
        :screen-reader-text-serializer="item => `Bar: ${item.name}`"
        highlightClass="special-highlight-class"
        @hit="selectedbar = $event"
        :minMatchingChars="3"
        placeholder="Local bar"
        inputClass="shadow appearance-none border rounded w-full py-2 px-3
          text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
        inputName="bar"
        :disabledValues="(selectedbar ? [selectedbar.name] : [])"
        @input="getLocalBars"
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
  props: {
    localcity: String
  },
  data(){
    return {
      query: '',
      selectedbar: null,
      bars: []
    }
  },
  methods: {
    getLocalBars: debounce(function() {
      console.log('this.localcity: ', this.localcity)
    }, 500)
  }
}
</script>


<style scoped>

</style>