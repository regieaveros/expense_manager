<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
                <strong>Expense was updated successfully!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                <strong>Expense was deleted!</strong>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mb-lg-4 mb-0">
                <table v-show="expenses.length != 0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Expense Category</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="expense in this.expenses" :key="expense.id" @click="toggleEdit(expense)" data-toggle="modal" data-target="#modal_expenses">
                            <td>{{ expense.expense_category_name }}</td>
                            <td>&dollar;{{ expense.amount }}</td>
                            <td>{{ expense.entry_date }}</td>
                            <td>{{ formattedDate(expense.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-5 pt-5" v-show="expenses.length == 0">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_expenses" @click="toggleAdd()">Add Expense</button>
                </div>
            </div>
        </div>

        <expenses-modal
            :expense_categories="expense_categories"
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
                expenses: [],
                expense_categories: [],
                form: new Form({
                    expense_category_id: '',
                    amount: '',
                    entry_date: '',
                }),
                showEdit: false,
                showAdd: false,
                expense_id: null
            }
        },
        mounted() {
            this.getAll();
            this.getAllExpenseCategory();
        },
        methods: {
            toggleAdd() {
                this.showAdd = true;
                this.showEdit = false;
                this.form.reset();
            },
            toggleEdit(expense) {
                this.form.expense_category_id = expense.expense_category_id;
                this.form.amount = expense.amount;
                this.form.entry_date = expense.entry_date;
                this.form.errors.clear();
                this.expense_id = expense.id;
                this.showEdit = true;
                this.showAdd = false;
            },
            getAll() {

                axios.get('expenses/data')
                .then(response => {
                    this.expenses = response.data
                }); 
            },
            getAllExpenseCategory() {

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

                axios.post('expenses/store', this.form)
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

                axios.put('expenses/update/'+this.expense_id, this.form)
                .then((response) => {
                    this.getAll();
                    $('#modal_expenses').modal('hide');
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

                axios.delete('expenses/delete/'+this.expense_id)
                .then((response) => {
                    this.getAll();
                    $('#modal_expenses').modal('hide');
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