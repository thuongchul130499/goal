<template>
    <form method="post" @submit.prevent="submit" id="form-task">
        <div class="modal-body">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="grid">
                        <p class="grid-header"></p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area text-info">
                                                <label for="inputType1"> <i class="mdi mdi-bullseye"></i>{{ lang.goal.title }}</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="title" 
                                                    v-model.trim="$v.title.$model"
                                                    :class="{
                                                        'is-invalid': ($v.title.$error || errors.title),
                                                        'is-valid':!$v.title.$invalid,
                                                    }"
                                                    placeholder="Object title">
                                                    <div class="invalid-feedback">
                                                        <span v-if="!$v.title.required"> Title không được bỏ trống </span>
                                                        <span v-if="!$v.title.maxLength"> Title không quá dài </span>
                                                        <span v-if="errors.title">{{ errors.title[0] }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area text-info">
                                                <label for="inputType9"> <i class="mdi mdi-laptop-mac"></i> {{ lang.goal.desc }}</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <textarea 
                                                    name="note" 
                                                    class="form-control" 
                                                    cols="12" rows="5"
                                                    v-model.trim="$v.description.$model"
                                                    :class="{
                                                        'is-invalid':($v.description.$error || errors.description),
                                                        'is-valid':!$v.description.$invalid,
                                                    }"
                                                    ></textarea>
                                                    <div class="invalid-feedback">
                                                        <span v-if="!$v.description.required"> Nội dung không được bỏ trống </span>
                                                        <span v-if="!$v.description.maxLength">  Nội dung không quá dài </span>
                                                        <span v-if="errors.description">{{ errors.description[0] }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ lang.close }}</button>
            <button type="submit" class="btn btn-primary btn-sm" id="save">{{ lang.save }}</button>
        </div>
    </form>
</template>
<script>
    import { required, maxLength, between } from 'vuelidate/lib/validators';
    export default {
        name: 'Goal',
        props: ['lang', 'id', 'task'],
        data(){
            return {
                'title': '',
                'description': '',
                'errors': []
            }
        },
        validations: {
            title: {
                required,
                maxLength: maxLength(255)
            },
            description: {
                required,
                maxLength: maxLength(2000)
            }

        },
        mounted(){
            this.title = this.task ? this.task.title : '';
            this.description = this.task ? this.task.note : '';
        },
        methods: {
            async submit($e){
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    let fd = new FormData($e.target);
                    if(this.task) {
                        window.axios.put(`/tasks/${this.task.id}`, {
                            title: this.title,
                            note: this.description,
                            goal_id: this.id
                        })
                        .then( e => {
                            location.reload();
                        })
                        .catch( e => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors
                            }
                        });
                    } else {
                        window.axios.post(`/goal/${this.id}/task`, fd)
                            .then( e => {
                                location.reload();
                            })
                            .catch( e => {
                                if (e.response.status === 422) {
                                    this.errors = e.response.data.errors
                                }
                            });
                    }
                }
            }
        }
    }
</script>
