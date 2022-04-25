<template>
  <div class="container mt-5">
      <b-button variant="danger">Button</b-button>

    <example-component></example-component>
    <div class="container">
      <div class="large-12 medium-12 small-12 cell">
        <label
          >File
          <input
            type="file"
            id="file"
            ref="file"
            v-on:change="handleFileUpload()"
          />
        </label>
        <button v-on:click="submitFile()">Submit</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      file: "",
    };
  },
  methods: {
    // view(currencyId) {
    //   this.$router.push({ name: "view", params: { currencyId: currencyId } });
    // },

    handleFileUpload(event) {
      this.file = this.$refs.file.files[0];
    },

    submitFile() {
      let formData = new FormData();
      // console.log(this.file);

      formData.append("file", this.file);
      for (var key of formData.entries()) {
        console.log(key[0] + ", " + key[1]);
      }
      axios
        .post("/postOriginalTrips", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(function () {
          console.log("SUCCESS!! postOriginalTrips");
        })
        .catch(function () {
          console.log("FAILURE!! postOriginalTrips");
        });
    },
  },
};
</script>
