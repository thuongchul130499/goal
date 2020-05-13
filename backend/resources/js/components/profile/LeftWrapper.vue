<template>
    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
        <div class="card rounded">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="card-title mb-0">Giới thiệu</h6>
                    <div class="dropdown" v-if="user.id === current">
                        <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item d-flex align-items-center" href="#" @click.prevent="editting = !editting">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm mr-2">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                                <span class="">Edit</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-branch icon-sm mr-2">
                                    <line x1="6" y1="3" x2="6" y2="15"></line>
                                    <circle cx="18" cy="6" r="3"></circle>
                                    <circle cx="6" cy="18" r="3"></circle>
                                    <path d="M18 9a9 9 0 0 1-9 9"></path>
                                </svg> <span class="">Update</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm mr-2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg> <span class="">View all</span></a>
                        </div>
                    </div>
                </div>
                <textarea v-if="editting" class="form-control" v-model="intro.bio">{{ intro.bio }}</textarea>
                <p v-else>{{ user.bio }}</p>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Tham gia:</label>
                    <p class="text-muted">{{ convert(user.created_at) }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lives:</label>
                    <input type="text" class="form-control" v-model="intro.profile.address" v-if="editting">
                    <p class="text-muted" v-else >{{ intro.profile.address }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Đến từ:</label>
                    <input type="text" class="form-control" v-model="intro.profile.from" v-if="editting" placeholder="Bạn đến từ đâu?">
                    <p class="text-muted" v-else >{{ intro.profile.from }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Mối quan hệ:</label>
                    <input type="text" class="form-control" v-model="intro.profile.relationship" v-if="editting" placeholder="Tình trạng hôn nhân?">
                    <p class="text-muted" v-else >{{ intro.profile.relationship }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lives:</label>
                    <input type="date" class="form-control" v-model="intro.profile.date_of_birth" v-if="editting">
                    <p class="text-muted" v-else >{{ intro.profile.date_of_birth }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Làm việc tại:</label>
                    <input type="text" class="form-control" v-model="intro.profile.workplace" v-if="editting">
                    <p class="text-muted" v-else >{{ intro.profile.workplace }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                    <p class="text-muted">{{ user.email }}</p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                        <span class="mdi mdi-facebook-box"></span> Facebook:
                    </label>
                    <input type="text" class="form-control" v-if="editting" v-model="intro.profile.website.fb" placeholder="Hãy nhập link của bạn">
                    <p class="text-muted" v-else> {{ intro.profile.website.fb || 'Chưa có' }} </p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                        <span class="mdi mdi-twitter-box"></span> Twitter:
                    </label>
                    <input type="text" class="form-control" v-if="editting" v-model="intro.profile.website.twitter" placeholder="Hãy nhập link của bạn">
                    <p class="text-muted" v-else> {{ intro.profile.website.twitter || 'Chưa có' }} </p>
                </div>
                <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                        <span class="mdi mdi-instagram"></span> Instagram:
                    </label>
                    <input type="text" class="form-control" v-if="editting" v-model="intro.profile.website.inst" placeholder="Hãy nhập link của bạn">
                    <p class="text-muted" v-else> {{ intro.profile.website.inst || 'Chưa có' }} </p>
                </div>
                <div class="mt-3 d-flex pull-right" v-if="editting">
                    <div class="btn btn-success has-icon btn-sm btn-rounded" @click.prevent="saveIntro">
                          <i class="mdi mdi-account-plus-outline"></i>Lưu
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import swal from '../../../../node_modules/sweetalert';

export default {
    props: ['current'],
    data(){
        return {
            intro: {
                bio: '',
                profile: {
                    address: '',
                    website: {
                        fb: '',
                        inst: '',
                        twitter: ''
                    },
                    relationship: '',
                    from: '',
                    date_of_birth: null,
                    workplace: '',
                }
            },
            editting: false,
        }
    },
    mounted(){
        if (this.user.profile !== null) {
            for ( let item in this.intro) {
                if (item === 'profile' && this.user[item].website === null) {
                    this.intro[item] = this.user[item];
                    this.intro[item].website = {
                            fb: '',
                            inst: '',
                            twitter: ''
                    }
                } else {
                    this.intro[item] = this.user[item]
                }
            }
        }
    },
    computed: {
        ...mapGetters([
            'user'
        ])
    },
    methods: {
        convert(date){
            let newDate = new Date(date);
            return newDate.getFullYear() + "/" + newDate.getMonth() + "/" + newDate.getDate();
        },
        saveIntro() {
            this.$store.dispatch('saveIntro', this.intro)
                .then(e => {
                    this.editting = false;
                    this.$store.commit('setUser', e.data.data);
                }).catch(e => {
                    if (e.response.status === 422) {
                        swal({
                            title: 'Warning',
                            text: e.response.data.message,
                            icon: 'warning',
                        })
                    }
                });
        }
    }
}
</script>