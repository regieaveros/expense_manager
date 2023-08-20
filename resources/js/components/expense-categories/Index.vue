<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
                <strong>Expense Cataegory was updated successfully!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                <strong>Expense Category was deleted!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mb-lg-4 mb-0">

                <table v-show="expense_categories.length != 0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Display Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="expense_category in this.expense_categories" :key="expense_category.id" @click="toggleEdit(expense_category)" data-toggle="modal" data-target="#modal_expense_categories">
                            <td>{{ expense_category.display_name }}</td>
                            <td>{{ expense_category.description }}</td>
                            <td>{{ formattedDate(expense_category.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div v-show="expense_categories.length == 0" class="mt-5 pt-5">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_expense_categories" @click="toggleAdd()">Add Expense Category</button>
                </div>
            </div>
        </div>

        <expense-categories-modal
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
                expense_categories: [],
                form: new Form({
                    display_name: '',
                    description: '',
                }),
                showEdit: false,
                showAdd: false,
                expense_category_id: null
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
            toggleEdit(expense_category) {
                this.form.display_name = expense_category.display_name;
                this.form.description = expense_category.description;
                this.form.errors.clear();
                this.expense_category_id = expense_category.id;
                this.showEdit = true;
                this.showAdd = false;
            },
            getAll() {

                axios.get('expense-categories/data')
                .then(response => {
                    this.expense_categories = response.data
                }); 
            },
            formattedDate(dateTime) {
                const date = new Date(dateTime);
                return date.toISOString().split("T")[0];
            },
            Add() {

                axios.post('expense-categories/store', this.form)
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

                axios.put('expense-categories/update/'+this.expense_category_id, this.form)
                .then((response) => {
                    this.getAll();
                    $('#modal_expense_categories').modal('hide');
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

                axios.delete('expense-categories/delete/'+this.expense_category_id)
                .then((response) => {
                    this.getAll();
                    $('#modal_expense_categories').modal('hide');
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