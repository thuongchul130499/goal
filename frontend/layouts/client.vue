<template>
    <div class="container-fluid bg-gray-900">
        <Nav />
        <nuxt />
    </div>
</template>
<script>
import Nav from "~/components/Nav.vue";
import Footer from "~/components/Footer.vue";
export default {
  components: { Nav, Footer }
};
</script>