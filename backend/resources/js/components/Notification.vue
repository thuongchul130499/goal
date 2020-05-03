<template>
    <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="notificationDropdown">
        <div class="dropdown-header">
            <h6 class="dropdown-title">Thông báo</h6>
        <p class="dropdown-title-text">Bạn có {{ count }} thông báo chưa đọc</p>
        </div>
        <div class="dropdown-body">
            <notification-item v-for="unread in unreadNotifications" :unread="unread" :key="unread.id"></notification-item>
        </div>
        <div class="dropdown-footer">
            <a href="/notifications">View All</a>
        </div>
    </div>
</template>
<script>
    import NotificationItem from './NotificationItem.vue';
    export default {
        props: ['unreads', 'userid', 'count'],
        components: { NotificationItem },
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        methods: {
            markNotificationAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/markAsRead');
                }
            }
        },
    }
</script>