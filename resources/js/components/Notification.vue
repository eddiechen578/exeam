<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-globe" aria-hidden="true"></i>
            通知 <span class="badge badge-pill badge-warning">{{notifications.length}}</span>
        </a>
        <ul class="dropdown-menu text-center">
            <li v-for="notification in notifications">
                <a href="#" v-on:click="markAsRead(notification)">
                    你有新的訂單,<br>
                    請前往訂單頁面查看
                </a>
            </li>
            <li v-if="notifications.length == 0">
                沒有通知.
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        name:'notification',
        data(){
            return {
               notifications: ''
            }
        },
        methods:{
            getNotifications(){
                axios.post('/notification/get').then(res=>{
                    this.notifications = res.data;
                })
            },
            markAsRead(notification){
                var data = {
                    'id': notification.id
                }

                axios.post('/notification/read', data).then(res=>{
                    window.location.href = "/orders/" + notification.data.order.id
                });
            }

        },
        created(){
            this.getNotifications();

            var userId = $('meta[name="userId"]').attr('content');

            Echo.private('App.User.' + userId).notification((notification)=>{
                console.log(notification)
                // this.notifications.push(notification);
            });
        }
    }

</script>