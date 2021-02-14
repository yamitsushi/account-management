<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card o-hidden shadow-lg my-5 card-border">
                    <div class="card-body text-center">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Loading Data</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import router from '@/router/index'
    export default {
        methods: {
            ...mapActions('user', [
                'preload'
                ])
        },
        mounted() {
            this.preload(true)
            router.push({ name:'dashboard' })
        }
    }
</script>