<template>
  <div class="col-md-12 grid-margin">
    <div class="card rounded">
      <div class="card-body">
        <h6 class="card-title">Người theo dõi</h6>
        <div class="latest-photos">
          <div class="row">
            <div class="col-md-4" v-for="(follower, index) in user.followings" :key="index" v-if="index <= 10">
              <figure>
                <img class="img-fluid" :src="follower.ava" :alt="follower.fullname" style="max-width:50px"/>
              </figure>
            </div>
            <div class="col-md-4" v-if="user.followings.length > 10">
                <div class="btn btn-rounded social-icon-btn btn-behance m-auto">
                    + {{ user.followings.length - 10 }} 
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    props: ['user'],
}
</script>