<template>
    <div class="page-header">
        <h3 class="page-title"> {{ $route.meta.title }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{ name: 'dashboard' }">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $route.meta.title }}</li>
            </ol>
        </nav>
    </div>
</template>

<script>
    export default {

    }
</script>
