<template>

  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Payment Logging
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="requests"
      :search="search"
    >
      <template v-slot:item="row">
        <tr>
          <td>{{row.item.id}}</td>
          <td>{{row.item.user_id}}</td>
          <td>{{row.item.status}}</td>
          <td>{{row.item.charge_id}}</td>
          <td>{{row.item.updated_at}}</td>
        </tr>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import Axios from "axios";

export default {
  data () {
      return {
        search: '',
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: false,
            value: 'id',
          },
          { text: 'Payer id', value: 'sender_id' },
          { text: 'Status', value: 'status' },
          { text: 'Charge id', value: 'charge_id' },
          { text: 'Updated at', value: 'updated_at' },
        ],
        requests: [
        ],
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
    },

  mounted: function() {
    axios.get('/getAllPaymentLog').then( (response) => {
      this.requests = response.data;
    });
  }
};
</script>

