<template>
    <form method="POST" enctype="multipart/form-data" @submit.prevent="Add">
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
                <label for="role_id" class="col-4 col-form-label text-right">Role</label>
                <div class="col-8">
                    <select 
                        id="role_id"
                        :class="{'is-invalid' : form.errors.has('role_id')}"
                        class="form-control" 
                        v-model="form.role_id"
                        @change="form.errors.clear('role_id')"
                    >
                        <option 
                            v-for="role in this.roles" 
                            :key="role.id"
                            :value="role.id"
                        >
                            {{ role.display_name }}
                        </option>
                    </select>
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('role_id')" 
                        v-text="form.errors.get('role_id')"
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
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('password_confirmation')" 
                        v-text="form.errors.get('password_confirmation')"
                    ></div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</template>

<script>
    export default {
        props: [
            'roles',
            'form',
            'Add',
        ]
    }
</script>
