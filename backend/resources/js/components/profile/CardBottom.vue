<template>
  <div class="col-md-12 grid-margin">
    <div class="card rounded">
      <div class="card-body">
        <h6 class="card-title">Đề xuất cho bạn</h6>
        <div
          class="d-flex justify-content-between mb-2 pb-2 border-bottom"
          v-for="(user, index) in users"
          :key="index"
        >
          <div class="d-flex align-items-center hover-pointer">
            <img class="img-xs rounded-circle" :src="user.ava" alt="user.name" />
            <div class="ml-2">
              <a :href="`/users/${user.id}`">
                <p class="name">{{ user.fullname }}</p>
              </a>
              <p class="tx-11 text-muted">12 Mutual Friends</p>
            </div>
          </div>
          <button class="btn btn-icon">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="feather feather-user-plus"
              data-toggle="tooltip"
              title
              data-original-title="Connect"
            >
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="8.5" cy="7" r="4" />
              <line x1="20" y1="8" x2="20" y2="14" />
              <line x1="23" y1="11" x2="17" y2="11" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["users"])
  }
};
</script>
<style scoped>
  .name{
    text-overflow: ellipsis;
    overflow: hidden;
    width: 120px;
    height: 1.2em;
    white-space: nowrap;
  }
</style>