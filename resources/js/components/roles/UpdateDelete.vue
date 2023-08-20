<template>
    <form method="PUT" enctype="multipart/form-data" @submit.prevent="Update">
        <div class="modal-body">
            <div class="form-group row">
                <label for="display_name" class="col-4 col-form-label text-right">Display Name</label>
                <div class="col-8">
                    <input 
                        id="display_name"
                        type="text" 
                        :class="{'is-invalid' : form.errors.has('display_name')}" class="form-control" 
                        v-model="form.display_name"
                        @keydown="form.errors.clear('display_name')"
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('display_name')" 
                        v-text="form.errors.get('display_name')"
                    ></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-4 col-form-label text-right">Description</label>
                <div class="col-8">
                    <input 
                        id="description" 
                        type="text"
                        :class="{'is-invalid' : form.errors.has('description')}"
                        class="form-control" 
                        v-model="form.description"
                        @keydown="form.errors.clear('description')"
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('description')" 
                        v-text="form.errors.get('description')"
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
            'form',
            'Update',
            'Delete'
        ]
    }
</script>
