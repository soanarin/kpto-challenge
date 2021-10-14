<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div v-if="currency !== undefined">
                        <div class="card-header">{{ currency.name }}</div>
                        <ul>
                            <li>Price >> {{ currency.current_price }} USD</li>
                            <li>Last 24h >> {{ currency.price_change_24h }} USD, {{ currency.price_change_percentage_24h }} %</li>
                            <li>Total market cap >> {{ currency.market_cap }}</li>
                            <li>Volume 24h >> {{ currency.total_volume }}</li>
                            <li>Circulating supply >> {{ currency.circulating_supply }}</li>
                            <li>Popularity on Kriptomat >> {{ currency.market_cap_rank }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['list'],
    computed: {
        currencyId() {
            return this.$route.params.currencyId
        },
        currency() {
            return _.find(this.list, {id: this.$route.params.currencyId});
        }
    }
}
</script>
