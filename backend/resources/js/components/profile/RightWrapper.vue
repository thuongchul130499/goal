<template>
    <div class="d-none d-xl-block col-xl-3 right-wrapper">
        <div class="row">
            <CardTop :user="user" />
            <CardBottom :user="user" />
        </div>
    </div>
</template>
<script>
import CardTop from './CardTop';
import CardBottom from './CardBottom';

export default {
    props: ['user'],
    components: { CardTop, CardBottom }
}
</script>