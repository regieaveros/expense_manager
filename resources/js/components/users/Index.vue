<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
                <strong>User was updated successfully!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                <strong>User was deleted!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mb-lg-4 mb-0">
                <table v-show="users.length != 0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in this.users" :key="user.id" @click="toggleEdit(user)" data-toggle="modal" data-target="#modal_users">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role_name }}</td>
                            <td>{{ formattedDate(user.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-5 pt-5" v-show="users.length == 0">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_users" @click="toggleAdd()">Add Users</button>
                </div>
            </div>
        </div>

        <users-modal
            :roles="roles"
            :form="form"
            :Add="Add"
            :Update="Update"
            :Delete="Delete"
            :showAdd="showAdd"
            :showEdit="showEdit"
        />

    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                roles: [],
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role_id: '',
                    toggle: false,
                }),
                showEdit: false,
                showAdd: false,
                userId: null
            }
        },
        mounted() {
            this.getAll();
            this.getAllRole();
        },
        methods: {
            toggleAdd() {
                this.showAdd = true;
                this.showEdit = false;
                this.form.reset();
            },
            toggleEdit(user) {
                this.form.name = user.name;
                this.form.email = user.email;
                this.form.role_id = user.role_id;
                this.form.toggle = false;
                this.form.errors.clear();
                this.userId = user.id;
                this.showEdit = true;
                this.showAdd = false;
            },
            getAll() {

                axios.get('users/data')
                .then(response => {
                    this.users = response.data
                }); 
            },
            getAllRole() {

                axios.get('roles/data')
                .then(response => {
                    this.roles = response.data
                }); 
            },
            formattedDate(dateTime) {
                const date = new Date(dateTime);
                return date.toISOString().split("T")[0];
            },
            Add() {

                axios.post('users/store', this.form)
                .then((response) => {
                    this.form.reset();
                    this.getAll();
                    $('.alert-success').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-success').css('display', 'none');
                    }, 2500);
                })
                .catch(error => {
                    this.form.errors.record(error.response.data);
                });
            },
            Update() {

                axios.put('users/update/'+this.userId, this.form)
                .then((response) => {
                    this.getAll();
                    this.form.reset();
                    $('#modal_users').modal('hide');
                    $('.alert-primary').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-primary').css('display', 'none');
                    }, 2500);
                })
                .catch(error => {
                    this.form.errors.record(error.response.data);
                });
            },
            Delete() {

                axios.delete('users/delete/'+this.userId)
                .then((response) => {
                    this.getAll();
                    $('#modal_users').modal('hide');
                    $('.alert-danger').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-danger').css('display', 'none');
                    }, 2500);
                })
                .catch(error => {
                    console.log("Error occurred.");
                });
            }
        }
    }
</script>