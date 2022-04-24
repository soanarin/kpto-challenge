<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <label>Select type</label>
        <v-select
          label="typeLabel"
          :options="transfer_types"
          v-model="transferType"
        ></v-select>
        <label>Select date</label>
        <v-select :options="transferDates" v-model="transferDate"></v-select>
        <label>Select gateway</label>
        <v-select
          label="typeLabel"
          :options="gateways"
          v-model="gateway"
        ></v-select>

        <div class="container">
          <div class="row" v-for="trip in trips">
            <div class="col-sm">
              {{ trip.transfer_nr }}
            </div>
            <div class="col-sm">
              {{ trip.origin_time }}
            </div>
            <div class="col-sm">
              {{ trip.origin3 }}
            </div>
            <div class="col-sm">
              {{ trip.destination1 }}
            </div>
             <div class="col-sm">
              {{ trip.total }}
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["list"],
  data() {
    return {
      transferType: null,
      transfer_types: [
        {
          transferType: "flight_arrival",
          typeLabel: "Arrival",
        },
        {
          transferType: "flight_departure",
          typeLabel: "Departure",
        },
      ],
      transferDates: [],
      transferDate: null,
      gateways: [],
      gateway: null,
      trips: [],
    };
  },
  computed: {
    // currencyId() {
    //   return this.$route.params.currencyId;
    // },
    // currency() {
    //   return _.find(this.list, { id: this.$route.params.currencyId });
    // },
  },
  methods: {
    getTransferDates() {
      let self = this;
      axios
        .get("/getTransferDates", {
          params: {
            type: this.transferType.transferType,
          },
        })
        .then(function (response) {
          //   console.log(response);
          console.log(response.data.result.allTransferDates);
          //   console.log(response.data.result.nonBusedDates);
          self.transferDates = response.data.result.allTransferDates;
        })
        .catch(function (error) {
          console.log("FAILURE!! getTransferDates");
          console.log(error);
        });
    },
    getGateways() {
      let self = this;
      axios
        .get("/getGateways", {
          params: {
            type: this.transferType.transferType,
            transferDate: this.transferDate,
          },
        })
        .then(function (response) {
          console.log(response);
          //   console.log(response.data.result.allTransferDates);
          //   console.log(response.data.result.nonBusedDates);
          self.gateways = response.data.result;
        })
        .catch(function (error) {
          console.log("FAILURE!! getTransferGateways");
          console.log(error);
        });
    },
    getTripsPlanning() {
      let self = this;
      axios
        .get("/getTripsPlanning", {
          params: {
            type: this.transferType.transferType,
            transferDate: this.transferDate,
            gateway: this.gateway,
          },
        })
        .then(function (response) {
          console.log(response);
          //   console.log(response.data.result.allTransferDates);
          //   console.log(response.data.result.nonBusedDates);
          self.trips = response.data.result;
        })
        .catch(function (error) {
          console.log("FAILURE!! getTripsPlanning");
          console.log(error);
        });
    },
  },
  watch: {
    transferType(newValue, oldValue) {
      this.getTransferDates();
    },
    transferDate(newValue, oldValue) {
      this.getGateways();
    },
    gateway(newValue, oldValue) {
      this.getTripsPlanning();
    },
  },
};
</script>
