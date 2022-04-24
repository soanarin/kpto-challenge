<template>
  <div class="container mt-5">
    <example-component></example-component>
    <div class="container">
      <div class="large-12 medium-12 small-12 cell">
        <label
          >File
          <input type="file"  id="file" ref="file" v-on:change="handleFileUpload()" />
        </label>
        <button v-on:click="submitFile()">Submit</button>

      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Currencies</div>
          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col-sm">Currency</div>
                <div class="col-sm">Price</div>
                <div class="col-sm">Details</div>
              </div>
              <div class="row" v-for="item in list">
                <div class="col-sm">
                  {{ item.name }}
                </div>
                <div class="col-sm">{{ item.current_price }} USD</div>
                <div class="col-sm">
                  <a href="#" @click="view(item.id)">view</a>
                </div>
              </div>
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
      file: "",
    };
  },
  methods: {
    view(currencyId) {
      this.$router.push({ name: "view", params: { currencyId: currencyId } });
    },

    handleFileUpload(event) {
      this.file = this.$refs.file.files[0];
    },

    submitFile() {
      let formData = new FormData();
// console.log(this.file);

      formData.append("file", this.file);
      for (var key of formData.entries()) {
        console.log(key[0] + ', ' + key[1]);
    }
      axios
        .post("/postOriginalTrips", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(function () {
          console.log("SUCCESS!!");
        })
        .catch(function () {
          console.log("FAILURE!!");
        });
    },
  },
};
</script>
