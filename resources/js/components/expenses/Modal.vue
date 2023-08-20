<template>
    <div class="modal fade" id="modal_expenses" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addRolesModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="showEdit">Edit Expense</h5>
                    <h5 class="modal-title" v-else-if="showAdd">Add Expense</h5>
                    <div v-else></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
                    <strong>Expense was added successfully!</strong>
                    <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div v-if="showEdit">
                    <expenses-update-delete
                        :expense_categories="expense_categories"
                        :form="form"
                        :Update="Update"
                        :Delete="Delete"
                    />
                </div>
                <div v-else-if="showAdd">
                    <expenses-create
                        :expense_categories="expense_categories"
                        :form="form" 
                        :Add="Add" 
                    />
                </div>
                <div v-else></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'expense_categories',
            'form',
            'Add',
            'Update',
            'Delete',
            'showAdd',
            'showEdit',
        ],
    }
</script>
