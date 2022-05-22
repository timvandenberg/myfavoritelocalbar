<template>
  <div>
    <div class="pl-1 pb-2 pt-3">
      Selected user: <span v-if="selecteduser">{{selecteduser.login}}</span>
    </div>

    <vue-typeahead-bootstrap
        class="mb-4"
        v-model="query"
        :data="users"
        :serializer="item => item.login"
        :screen-reader-text-serializer="item => `Github user ${item.login}`"
        highlightClass="special-highlight-class"
        @hit="selecteduser = $event"
        :minMatchingChars="3"
        placeholder="Search Github Users"
        inputClass="special-input-class"
        :disabledValues="(selecteduser ? [selecteduser.login] : [])"
        @input="lookupUser"
    >
      <template slot="suggestion" slot-scope="{ data, htmlText }">
        <div class="d-flex align-items-center">
          <img
              class="rounded-circle"
              :src="data.avatar_url"
              style="width: 40px; height: 40px;" />

          <!-- Note: the v-html binding is used, as htmlText contains
               the suggestion text highlighted with <strong> tags -->
          <span class="ml-4" v-html="htmlText"></span>
          <i class="ml-auto fab fa-github-square fa-2x"></i>
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
      selecteduser: null,
      users: []
    }
  },

  methods: {
    lookupUser: debounce(function(){
      // in practice this action should be debounced
      fetch(`https://api.github.com/search/users?q=${this.query}`)
          .then(response => {
            return response.json();
          })
          .then(data => {
            this.users = data.items;
          })
    }, 500)
  }
}
</script>


<style scoped>

</style>