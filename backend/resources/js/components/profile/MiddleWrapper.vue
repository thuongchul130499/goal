<template>
  <div class="col-md-8 col-xl-6 middle-wrapper">
    <div class="row" v-if="current == user.id">
      <div class="col-md-12 grid-margin">
        <div class="card rounded mb-2">
          <div class="card-header">
            <textarea class="form-control" v-if="!posting" @click.prevent="posting = !posting">{{ "Ngày hôm nay của bạn thế nào?, " + user.fullname }}</textarea>
            <div v-else>
              <ckeditor tag-name="textarea" v-model="content" :config="editorConfig" autoforcus></ckeditor>
              <div
                id="my-strictly-unique-vue-upload-multiple-image"
                style="display: flex; justify-content: center;"
              >
                <vue-upload-multiple-image
                  @upload-success="uploadImageSuccess"
                  @before-remove="beforeRemove"
                  @edit-image="editImage"
                  :data-images="images"
                  idUpload="myIdUpload"
                  editUpload="myIdEdit"
                ></vue-upload-multiple-image>
              </div>
              <button
                type="button"
                class="btn btn-success btn-sm has-icon btn-block mt-0"
                @click.prevent="post"
              >
                <i class="mdi mdi-comment-processing-outline"></i>Đăng
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin" v-if="getPosts.length > 0">
        <Card v-for="(post, index) in getPosts" :key="index" :post="post" />
      </div>
      <div class="col-md-12 grid-margin" v-if="getPosts.length > 0 && !getLoading">
        <div class="card rounded mb-2 p-2">
          <center>
            <p>Không có gì</p>
          </center>
        </div>
      </div>
      <Loader v-if="getLoading" />
    </div>
  </div>
</template>
<script>
import CKEditor from "ckeditor4-vue";
import Card from "./../post/Card";
import VueUploadMultipleImage from "vue-upload-multiple-image";
import { mapActions, mapGetters } from "vuex";
import Loader from "./../Loader";

export default {
  props: ["user", "current"],
  components: { Card, VueUploadMultipleImage, Loader },
  data() {
    return {
      posting: false,
      content: "",
      editorConfig: {
        startupFocus: true,
        toolbar: [
          ["Styles", "Format", "Font", "FontSize"],
          ["Bold", "Italic"],
          ["Undo", "Redo"]
        ]
      },
      images: [],
      fd: [],
      request: {
        user_id: this.user.id,
        page: 1
      },
      busy: false
    };
  },
  watch: {
    busy(busy) {
      if (busy) {
        this.fetchPost(this.request);
      }
    }
  },
  mounted() {
    window.addEventListener("scroll", () => {
      this.busy = this.bottomVisible();
    });
    this.fetchPost(this.request).then ( e => this.request.page ++);
  },
  methods: {
    post() {
      let fd = new FormData();
      this.fd.forEach(element => {
        fd.append("images[]", this.dataURLtoFile(element.path, element.name));
      });
      fd.append("content", this.content);
      window.axios
        .post("/posts", fd, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.$store.commit('addPost', response.data);
          swal({
            icon: "success",
            text: "success"
          });
        });
    },
    uploadImageSuccess(formData, index, fileList) {
      this.fd = fileList;
    },
    beforeRemove(index, done, fileList) {
      console.log("index", index, fileList);
      done();
    },
    editImage(formData, index, fileLisimagest) {
      console.log("edit data", formData, index, fileList);
    },
    dataURLtoFile(dataurl, filename) {
      var arr = dataurl.split(","),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

      while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
      }

      return new File([u8arr], filename, { type: mime });
    },
    bottomVisible() {
      const scrollY = window.scrollY;
      const visible = document.documentElement.clientHeight;
      const pageHeight = document.documentElement.scrollHeight;
      const bottomOfPage = visible + scrollY >= pageHeight;
      return bottomOfPage || pageHeight < visible;
    },
    ...mapActions(["fetchPost"])
  },
  computed: {
    ...mapGetters(["getPosts", "getLoading"])
  }
};
</script>
<style scoped>
#my-strictly-unique-vue-upload-multiple-image {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

h1,
h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>