<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link :to="{ name: 'home' }" class="navbar-brand"
            >Kripto</router-link
            >
            <button
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'home' }"
                        >
                            Home
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'view' }"
                        >
                            View Details
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'alerts' }"
                        >
                            Alerts
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="alert alert-warning" role="alert" v-if="alertedCurrencies.length !== 0">
                <ul>
                    <li v-for="currency in alertedCurrencies">{{ currency.name }} price has gone over max limit of {{ currency.max }} USD</li>
                </ul>
            </div>
            <router-view :list="list" :alerts="alerts" @created="getAlerts"></router-view>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            alerts: [],
            list: null,
            urlApiCurrencies: 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1&sparkline=false',
            alertedCurrencies: []
        }
    },
    methods: {
        getList() {
            let self = this
            self.list = null
            axios(this.urlApiCurrencies)
                .then(response => {
                    self.list = response.data
                    self.alertedCurrencies = []
                    self.checkAlerts()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        getAlerts() {
            let self = this
            self.alerts = []
            axios('/getalerts')
                .then(response => {
                    self.alerts = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        checkAlerts() {
            let self = this
            _.forEach(self.alerts, function(alert) {
                let alertedCurrency = _.find(self.list, {id: alert.currency_id});
                if (alertedCurrency.current_price > alert.max) {
                    alertedCurrency.max = alert.max
                    self.alertedCurrencies.push(alertedCurrency)
                }
            })
        }
    },
    created() {
        let self = this
        this.getList()
        this.getAlerts()

        setInterval(function(){
            self.getList()
        }, 5000);
    }
};
</script>
