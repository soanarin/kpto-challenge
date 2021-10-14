<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Currencies</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    Currency
                                </div>
                                <div class="col-sm">
                                    Price
                                </div>
                                <div class="col-sm">
                                    Details
                                </div>
                            </div>
                            <div class="row" v-for="item in list">
                                <div class="col-sm">
                                    {{ item.name }}
                                </div>
                                <div class="col-sm">
                                    {{ item.current_price }} USD
                                </div>
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
    props: ['list'],
    methods: {
        view(currencyId) {
            this.$router.push({ name: 'view', params: { currencyId: currencyId } })
        }
    }
}
</script>
