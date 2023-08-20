<template>
    <form method="PUT" enctype="multipart/form-data" @submit.prevent="Update">
        <div class="modal-body">
            
            <div class="form-group row">
                <label for="expense_category_id" class="col-4 col-form-label text-right">Role</label>
                <div class="col-8">
                    <select 
                        id="expense_category_id"
                        :class="{'is-invalid' : form.errors.has('expense_category_id')}"
                        class="form-control" 
                        v-model="form.expense_category_id"
                        @change="form.errors.clear('expense_category_id')"
                    >
                        <option 
                            v-for="expense_category in this.expense_categories" 
                            :key="expense_category.id"
                            :value="expense_category.id"
                        >
                            {{ expense_category.display_name }}
                        </option>
                    </select>
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('expense_category_id')" 
                        v-text="form.errors.get('expense_category_id')"
                    ></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-4 col-form-label text-right">Amount</label>
                <div class="col-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">&dollar;</span>
                        </div>
                        <input 
                            id="amount" 
                            type="number"
                            :class="{'is-invalid' : form.errors.has('amount')}"
                            class="form-control" 
                            v-model="form.amount"
                            @keydown="form.errors.clear('amount')"
                        />
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('amount')" 
                            v-text="form.errors.get('amount')"
                        ></div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group row">
                <label for="entry_date" class="col-4 col-form-label text-right">Entry Date</label>
                <div class="col-8">
                    <b-form-datepicker 
                        id="entry_date" 
                        :class="{'is-invalid' : form.errors.has('entry_date')}"
                        class="form-control" 
                        v-model="form.entry_date"
                        @change="form.errors.clear('entry_date')"
                    ></b-form-datepicker>
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('entry_date')" 
                        v-text="form.errors.get('entry_date')"
                    ></div>
                </div>
            </div>

        </div>
        <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-danger" @click="Delete()">Delete</button>
            <div class="m-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props: [
            'expense_categories',
            'form',
            'Update',
            'Delete'
        ]
    }
</script>
