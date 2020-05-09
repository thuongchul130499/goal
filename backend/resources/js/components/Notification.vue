<template>
    <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="notificationDropdown" id="notification-drop">
        <div class="dropdown-header">
            <h6 class="dropdown-title">Thông báo</h6>
        <p class="dropdown-title-text">Bạn có {{ count }} thông báo chưa đọc</p>
        </div>
        <div class="dropdown-body" id="notification-com">
            <notification-item v-for="noti in notifications" :noti="noti" :key="noti.id"></notification-item>
        </div>
        <div class="dropdown-footer row">
            <div class="col-6 pull-left cursor-pointer" @click.prevent="viewAll">
                <span class="badge">Xem tất cả</span>
            </div>
            <div class="col-6 pull-right cursor-pointer">
                <span class="badge" @click="markNotificationAsRead">Đánh dấu đã đọc</span>
            </div>
        </div>
    </div>
</template>
<script>
    import NotificationItem from './NotificationItem.vue';
    export default {
        props: ['notis', 'userid', 'count'],
        components: { NotificationItem },
        data(){
            return {
                notifications: this.notis
            }
        },
        methods: {
            markNotificationAsRead() {
                if (this.notifications.length) {
                    axios.post('/markAsRead').then( e => {
                        this.count = 0;
                        document.getElementById('notification-read').remove();
                        for (let item of document.getElementsByClassName('unread')) {
                            item.classList.remove('unread');
                        }
                    });
                }
            },
            viewAll(){
                window.location.replace('/notifications');
            }
        }
    }
</script>
<style scoped>
    #notification-com{
        max-height: 300px !important;
    }
    .cursor-pointer{
        cursor: pointer;
    }
</style>