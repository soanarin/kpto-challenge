<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div>
        <b-button v-b-modal.modal-1>Launch demo modal</b-button>

        <b-modal id="modal-1" title="Assign Bus">
          <p class="my-4">Assign Bus</p>
          <label>Bus ref</label>
          <b-form-input v-model="bus.ref"></b-form-input>
          <label>Bus size</label>
          <b-form-input v-model="bus.size"></b-form-input>
          <label>Supplier</label>
          <b-form-input v-model="bus.supplier"></b-form-input>
          <b-button @click="assignBus()"> Assign bus </b-button>
        </b-modal>
      </div>
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
              {{ trip.bus_id }}
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
              <a href="#" @click="assignBus(trip)"> {{ trip.total }} </a>
              <b-button v-b-modal.modal-1 @click="setTripForBus(trip)">
                {{ trip.total }}
              </b-button>
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
      tripForBus: null,
      bus: {
        ref: null,
        size: null,
        supplier: null,
      },
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
    assignBus() {
      let self = this;
      let trip = self.tripForBus;
      console.log(self.tripForBus);
      axios
        .post("/assignBus", {
          origin_date: trip.origin_date,
          // origim_time: trip.origin_time,
          destination1: trip.destination1,
          origin3: trip.origin3,
          total: trip.total,
          busSize: self.bus.size,
          busRef: self.bus.ref,
          busSupplier: self.bus.supplier,
        })
        .then(function (response) {
            console.log('...KKK');
          self.$bvModal.hide('modal-1');
          console.log(response);
          self.getTripsPlanning();
          //   console.log(response.data.result.allTransferDates);
          //   console.log(response.data.result.nonBusedDates);
          //   self.trips = response.data.result;
        })
        .catch(function (error) {
          console.log("FAILURE!! getTripsPlanning");
          console.log(error);
        });
    },
    setTripForBus(trip) {
      this.tripForBus = trip;
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
