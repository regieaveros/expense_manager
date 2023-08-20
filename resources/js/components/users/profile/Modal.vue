<template>
    <div class="modal fade" id="modal_profile" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addRolesModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="PUT" enctype="multipart/form-data" @submit.prevent="Update">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-4 col-form-label text-right">Name</label>
                            <div class="col-8">
                                <input 
                                    id="name"
                                    type="text" 
                                    :class="{'is-invalid' : form.errors.has('name')}" class="form-control" 
                                    v-model="form.name"
                                    @keydown="form.errors.clear('name')"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('name')" 
                                    v-text="form.errors.get('name')"
                                ></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label text-right">Email</label>
                            <div class="col-8">
                                <input 
                                    id="email" 
                                    type="email"
                                    :class="{'is-invalid' : form.errors.has('email')}"
                                    class="form-control" 
                                    v-model="form.email"
                                    @keydown="form.errors.clear('email')"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('email')" 
                                    v-text="form.errors.get('email')"
                                ></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label text-right">Password</label>
                            <div class="col-8">
                                <input 
                                    id="password"
                                    name="password"
                                    type="password"
                                    :class="{'is-invalid' : form.errors.has('password')}"
                                    class="form-control" 
                                    v-model="form.password"
                                    @keydown="form.errors.clear('password')"
                                    :disabled="form.toggle ? false : true"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('password')" 
                                    v-text="form.errors.get('password')"
                                ></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-4 col-form-label text-right">Confirm Password</label>
                            <div class="col-8">
                                <input 
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    :class="{'is-invalid' : form.errors.has('password_confirmation')}"
                                    class="form-control" 
                                    v-model="form.password_confirmation"
                                    @keydown="form.errors.clear('password_confirmation')"
                                    :disabled="form.toggle ? false : true"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('password_confirmation')" 
                                    v-text="form.errors.get('password_confirmation')"
                                ></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check mb-4 d-flex justify-content-end">
                                <input
                                    id="toggle"
                                    class="form-check-input checkbox-layout"
                                    type="checkbox" 
                                    v-model="form.toggle"
                                >
                                <label class="form-check-label h6 mt-2 pr-4" for="toggle">Show Password</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="m-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
   export default {
        
        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    toggle: false,
                }),
                userId: null
            }
        },
        mounted() {
            this.getUser();
        },
        methods: {
            getUser() {
                axios.get('users/profile')
                .then(response => {
                    this.form.name = response.data.name
                    this.form.email = response.data.email
                    this.userId = response.data.id
                }); 
            },
            Update() {

                axios.put('users/profile/'+this.userId, this.form)
                .then((response) => {
                    location.reload();
                })
                .catch(error => {
                    this.form.errors.record(error.response.data);
                });
            }
            
        }
    }
</script>
