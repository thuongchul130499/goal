<template>
    <form method="post" @submit.prevent="submit">
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
                                                    name="description" 
                                                    class="form-control" 
                                                    cols="12" rows="5"
                                                    v-model.trim="$v.description.$model"
                                                    :class="{
                                                        'is-invalid':($v.description.$error || errors.description),
                                                        'is-valid':!$v.description.$invalid,
                                                    }"
                                                    ></textarea>
                                                    <div class="invalid-feedback">
                                                        <span v-if="!$v.description.required"> Title không được bỏ trống </span>
                                                        <span v-if="!$v.description.minLengh"> Title không quá Ngắn </span>
                                                        <span v-if="!$v.description.maxLength"> Title không quá dài </span>
                                                        <span v-if="errors.description">{{ errors.description[0] }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-6">
                                                <div class="col-md-12 text-center">{{ lang.due_to }}</div>
                                                <div class="col-md-12 showcase_content_area">
                                                    <input 
                                                        type="date"
                                                        class="form-control"
                                                        name="due_to"
                                                        v-model="due_to"
                                                        :class="{
                                                            'is-invalid':errors.due_to,
                                                        }"
                                                    >
                                                    <div class="invalid-feedback">
                                                        <span v-if="errors.due_to">{{ errors.due_to[0] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12 text-center">{{ lang.started_at }}</div>
                                                <div class="col-md-12 showcase_content_area">
                                                    <input 
                                                        type="date" 
                                                        class="form-control" 
                                                        name="started_at"
                                                        v-model="started_at"
                                                        :class="{
                                                            'is-invalid':errors.started_at
                                                        }"
                                                    >
                                                    <div class="invalid-feedback">
                                                        <span v-if="errors.started_at">{{ errors.started_at[0] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row showcase_row_area mb-3">
                                            <div class="col-md-3 showcase_text_area text-info">
                                                <label> <i class="mdi mdi-message-image"></i>{{ lang.image }}</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" @change="selectFile" ref="image">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
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
    import { required, minLength, maxLength, between } from 'vuelidate/lib/validators';
    export default {
        name: 'Goal',
        props: ['lang'],
        data(){
            return {
                'title': '',
                'description': '',
                'due_to': '',
                'started_at': '',
                'image': null,
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
                minLength: minLength(50),
                maxLength: maxLength(2000)
            }

        },
        methods: {
            async submit($e){
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    let file = this.$refs.image.files;
                    if (this.validate(file)) {
                        let fd = new FormData($e.target);
                        window.axios.post('/goals', fd)
                            .then( e => {
                                location.reload();
                            })
                            .catch( e => {
                                if (e.response.status === 422) {
                                    this.errors = e.response.data.errors
                                }
                            })
                    }
                }
            },
            selectFile(){
                let file = this.$refs.image.files;
                if (this.validate(file) === '') {
                    return;
                }
                alert(this.validate(file));
                file.value = '';
                return;
            },
            validate(file, type = false){
                if(type) return '';
                const MAX_SIZE = 2000000;
                const allowedTypes = ['image/jpeg', 'image/png', "image/jpg"];
                if(file !== undefined){
                    if(file.size > MAX_SIZE){
                        return `Max size : ${MAX_SIZE/1000}Kb`;
                    }
                    if(!allowedTypes.includes(file.type)){
                        return 'Not an image';
                    }
                    return '';
                }else{
                    'Không được trống'
                }
            }
        }
    }
</script>
