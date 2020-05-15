<template>
  <div class="row figure__em">
    <div class="col-12 grid-margin">
      <div class="profile-header">
        <div class="cover">
          <div class="gray-shade"></div>
          <figure class="figure__em figure">
            <img
              :src="user.bg"
              class="img-fluid figure"
              alt="profile cover"
              ref="imgBg"
              style="max-height: 300px"
            />
          </figure>
          <div class="cover-body d-flex justify-content-between align-items-center mb-5">
            <div>
              <img class="profile-pic" :src="user.ava" alt="profile" />
              <span class="profile-name">{{ user.fullname }}</span>
            </div>
            <div class="d-none d-md-block" v-if="current != user.id">
              <button
                class="btn btn-outline-danger has-icon btn-sm follow"
                v-if="isFollow"
                :data-user-id="user.id"
                :data-type="'unfollow'"
                :data-req="true"
              >Bỏ theo dõi</button>
              <button
                class="btn btn-success has-icon btn-sm follow"
                v-else
                :data-user-id="user.id"
                :data-type="'follow'"
                :data-req="true"
              >
                <i class="mdi mdi-account-plus-outline"></i>Theo dõi
              </button>
            </div>
            <div class="d-none d-md-block" v-else>
                <button class="btn btn-rounded social-btn-outlined btn-instagram" @click="$refs.backg.click()">
                    <i class="mdi mdi-camera-party-mode"></i>Đổi ảnh bìa
                </button>
                <input type="file" name="background" ref="backg" class="hide" accept="image/*" @change="previewFile">
            </div>
          </div>
        </div>
        <div class="header-links">
          <ul class="links d-flex align-items-center mt-3 mt-md-0">
            <li class="header-link-item d-flex align-items-center active">
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
                class="feather feather-columns mr-1 icon-md"
              >
                <path
                  d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"
                />
              </svg>
              <a class="pt-1px d-none d-md-block" href="#">Timeline</a>
            </li>
            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
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
                class="feather feather-user mr-1 icon-md"
              >
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
              <a class="pt-1px d-none d-md-block" href="#">
                Người theo dõi
                <span class="text-muted tx-12 count-follower">{{ user.followers.length}}</span>
              </a>
            </li>
            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
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
                class="feather feather-users mr-1 icon-md"
              >
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
              <a class="pt-1px d-none d-md-block" href="#">
                Đang theo dõi
                <span class="text-muted tx-12">{{ user.followings.length}}</span>
              </a>
            </li>
            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
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
                class="feather feather-image mr-1 icon-md"
              >
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <polyline points="21 15 16 10 5 21" />
              </svg>
              <a class="pt-1px d-none d-md-block" href="#">Photos</a>
            </li>
            <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
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
                class="feather feather-video mr-1 icon-md"
              >
                <polygon points="23 7 16 12 23 17 23 7" />
                <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
              </svg>
              <a class="pt-1px d-none d-md-block" href="#">Videos</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: ["user", "current"],
  data(){
      return {
          file: '',
      }
  },
  computed: {
    ...mapGetters(["isFollow"])
  },
  methods: {
    previewFile(event) {
        this.file = event.target.files[0]
        let fd = new FormData();
        fd.append('background', this.file);
        window.axios.post( '/upload-image', fd, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }
        ).then(res => {
            this.$refs.imgBg.src = `${res.data.data.path}`
        })
        .catch(e => {
            console.log('FAILURE!!');
        });
    }
  }
};
</script>