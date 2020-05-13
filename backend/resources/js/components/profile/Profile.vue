<template>
    <div>
        <Loading v-if="Object.keys(user).length === 0" />
        <div v-else>
            <Header :user="user" :current="current"/>
            <div class="row profile-body">
                <LeftWrapper :current="current"/>
                <MiddleWrapper />
                <RightWrapper :user="user" />
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import Header from './Header';
import LeftWrapper from './LeftWrapper';
import MiddleWrapper from './MiddleWrapper';
import RightWrapper from './RightWrapper';
import Loading from './../Loading';
export default {
    props: ['current'],
    name: 'Profile',
    components: { Header, LeftWrapper, MiddleWrapper, RightWrapper, Loading },
    data(){
        return {
        }
    },
    mounted(){
        this.fetchUser();
    },
    computed: {
        ...mapGetters([
            'user'
        ])
    },
    methods: {
        ...mapActions([
            'fetchUser'
        ])
    }
}
</script>