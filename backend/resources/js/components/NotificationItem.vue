<template>
    <a :href="`/notification/${unread.slug + '?id=' +unread.id}`" @click.prevent="openNoti" ref="link">
        <div class="dropdown-list">
            <div class="icon-wrapper rounded-circle bg-inverse-warning text-warning">
                <i class="mdi" :class="`mdi-${unread.image}`"></i>
            </div>
            <div class="content-wrapper">
                <small class="name">{{ unread.title }}</small>
                <small class="content-text">{{ unread.content }}</small>
                <small class="name float-right"><b>{{ unread.time }}</b></small>
            </div>
        </div>
    </a>
</template>
<script>
    import swal from '../../../node_modules/sweetalert';
    export default {
        props:['unread'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){

        },
        methods: {
            openNoti(e){
                if (this.unread.type === 'logined') {
                    swal({
                        title: this.unread.title,
                        text: this.unread.content,
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
