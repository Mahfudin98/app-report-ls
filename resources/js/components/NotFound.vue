<template>
    <div class="rui-main">
        <div class="rui-page-error container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="mnb-30">404</h1>
                    <p class="display-2 mb-50 text-grey-5">Page Not Found</p>
                    <div>
                        <router-link :to="{ name: 'home' }" class="btn btn-brand btn-long">
                            Back Home
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
