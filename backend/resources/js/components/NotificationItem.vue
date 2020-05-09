<template>
    <a :href="`/notification/${noti.slug + '?id=' +noti.id}`" @click.prevent="openNoti" ref="link">
        <div class="dropdown-list" :class="{ unread: !noti.read }">
            <div class="icon-wrapper rounded-circle bg-inverse-warning text-warning">
                <i class="mdi" :class="`mdi-${noti.image}`"></i>
            </div>
            <div class="content-wrapper">
                <small class="name">{{ noti.title }}</small>
                <small class="content-text">{{ noti.content }}</small>
                <small class="name float-right"><b>{{ noti.time }}</b></small>
            </div>
        </div>
    </a>
</template>
<script>
    import swal from '../../../node_modules/sweetalert';
    export default {
        props:['noti'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){

        },
        methods: {
            openNoti(e){
                if (this.noti.type === 'logined') {
                    swal({
                        title: this.noti.title,
                        text: this.noti.content,
                        icon: 'warning',
                        button: {
                            text: 'Đổi mật khẩu',
                            closeModal: false,
                        },
                    }).then( e => {
                        if(e){
                            window.location.replace('/');
                        }
                    });
                } else {
                    window.location.replace(this.$refs.link.href);
                }
            }
        }
    }
</script>
<style>
    .unread{ 
        background: #e9ebef;
    }
</style>