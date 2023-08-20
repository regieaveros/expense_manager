<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
                <strong>Role was updated successfully!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                <strong>Role was deleted!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mb-lg-4 mb-0">
                <table v-show="roles.length != 0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Display Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in this.roles" :key="role.id" @click="toggleEdit(role)" data-toggle="modal" data-target="#modal_roles">
                            <td>{{ role.display_name }}</td>
                            <td>{{ role.description }}</td>
                            <td>{{ formattedDate(role.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-5 pt-5" v-show="roles.length == 0">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_roles" @click="toggleAdd()">Add Role</button>
                </div>
            </div>
        </div>

        <roles-modal
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
                roles: [],
                form: new Form({
                    display_name: '',
                    description: '',
                }),
                showEdit: false,
                showAdd: false,
                role_id: null
            }
        },
        mounted() {
            this.getAll();
        },
        methods: {
            toggleAdd() {
                this.showAdd = true;
                this.showEdit = false;
                this.form.reset();
            },
            toggleEdit(role) {
                this.form.display_name = role.display_name;
                this.form.description = role.description;
                this.form.errors.clear();
                this.role_id = role.id;
                this.showEdit = true;
                this.showAdd = false;
            },
            getAll() {

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

                axios.post('roles/store', this.form)
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

                axios.put('roles/update/'+this.role_id, this.form)
                .then((response) => {
                    this.getAll();
                    $('#modal_roles').modal('hide');
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

                axios.delete('roles/delete/'+this.role_id)
                .then((response) => {
                    this.getAll();
                    $('#modal_roles').modal('hide');
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