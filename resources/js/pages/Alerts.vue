<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <v-select :options="['Canada', 'United States']"></v-select>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alert limits</div>
                    <div class="container" v-if="!editing">
                        <div class="row">
                            <div class="col-sm">
                                Currency
                            </div>
                            <div class="col-sm">
                                Min
                            </div>
                            <div class="col-sm">
                                Max
                            </div>
                            <div class="col-sm">
                                Edit
                            </div>
                        </div>
                        <div class="row" v-for="item in alerts">
                            <div class="col-sm">
                                {{ item.currency_id }}
                            </div>
                            <div class="col-sm">
                                {{ item.min }}
                            </div>
                            <div class="col-sm">
                                {{ item.max }}
                            </div>
                            <div class="col-sm">
                                <a href="#" @click="editAlert(item)">edit</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" @click="addAlert()">Add Alert</button>
                    </div>

                    <div class="container" v-if="editing">
                        <form>
                            <div class="form-group">
                                <label for="selcur">Select currency</label>
                                <select class="form-control" id="selcur" v-model="currencyId">
                                    <option v-for="currency in list" :value="currency.id">{{ currency.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cmin">Min</label>
                                <input type="text" class="form-control" id="cmin" v-model="min">
                            </div>
                            <div class="form-group">
                                <label for="cmax">Max</label>
                                <input type="text" class="form-control" id="cmax" v-model="max">
                            </div>
                            <button class="btn btn-primary" @click="submitAlerts()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['alerts', 'list', 'created'],
    data() {
        return {
            editing: false,
            currencyId: null,
            min: null,
            max: null
        }
    },
    methods: {
        addAlert() {
            this.currencyId = null
            this.min = null
            this.max = null
            this.editing = true
        },
        editAlert(item) {
            this.currencyId = item.currencyId
            this.min = item.min
            this.max = item.max
            this.editing = true
        },
        submitAlerts() {
            this.editing = true
            let self = this;
            axios.post('/postalerts', {
                currency_id: this.currencyId,
                min: this.min,
                max: this.max
            })
                .then(function (response) {
                    self.editing = false
                    self.$emit('created');
                    alert('Alert saved successfully !')
                })
                .catch(function (error) {
                    self.editing = false
                    alert('There was some error, alert was not saved!')
                });
        }
    }
}
</script>
