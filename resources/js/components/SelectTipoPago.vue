<template>
    <div>
        <label v-text="label+':'"></label>
        <a href="#" v-if="item" @click.prevent="editItem(item)" v-show="!disabled">
            editar
        </a>

        <multiselect v-model="item" :options="options" label="nombre" placeholder="Seleccione uno..." :disabled="disabled">
            <template  slot="noResult">
                <a class="btn btn-sm btn-block btn-success" href="#" @click.prevent="newItem()">
                    <i class="fa fa-plus"></i> Nuevo
                </a>
            </template >
        </multiselect>


        <input type="hidden" :name="name" :value="getId(item)">


        <div class="modal fade" :id="id" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">
                            <span v-text="formTitle"></span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="save">
                        <div class="modal-body">
                            <div class="form-row">

                                <div class="form-group col-sm-12">
                                    <label >Nombre <span  class="text-danger">*</span></label>
                                    <input type="text" class="form-control" v-model="editedItem.nombre" >
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <span v-text="loading ? 'GUARDANDO...' : 'GUARDAR'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    name: 'select_tipo_pago',
    created() {
        this.item = this.value;
        this.getItems();

    },
    props:{
        value: {
            default: null,
            required: true
        },
        items:{
            type: Array,
            default() {
                return [];
            },
            required: false,
        },

        name: {
            type: String,
            default: 'tipo_pago_id'
        },
        label:{
            type: String,
            required: true,
        },
        id:{
            type: String,
            default: 'modal_select_tipo_pago'
        },
        disabled:{
            type: Boolean,
            default: false
        }
    },

    data: () => ({
        loading: false,

        item: null,
        items_api: [],
        editedItem: {
            id : 0,
        },
        defaultItem: {
            id : 0,
            nombre: '',
        },
    }),
    methods: {
        getId(item){
            if(item)
                return item.id;

            return null
        },
        newItem () {
            $("#"+this.id).modal('show');
            this.editedItem = Object.assign({}, this.defaultItem);
        },
        editItem (item) {
            $("#"+this.id).modal('show');
            this.editedItem = Object.assign({}, item);

        },
        close () {
            $("#"+this.id).modal('hide');
            this.loading = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
            }, 300)
        },

        async getItems () {

            try {

                var res = await axios.get(route('api.tipo_pagos.index'));

                this.items_api  = res.data.data;

            }catch (e) {
                notifyErrorApi(e);
            }

        },
        async save () {

            this.loading = true;


            try {

                const data = this.editedItem;

                if(this.editedItem.id === 0){

                    var res = await axios.post(route('api.tipo_pagos.store'),data);

                }else {

                    var res = await axios.patch(route('api.tipo_pagos.update',this.editedItem.id),data);

                }

                logI(res.data);

                const item  = res.data.data;

                this.actualizaSelect(item);

                iziTs(res.data.message);

                this.close();

            }catch (e) {
                notifyErrorApi(e);
                this.loading = false;
            }

        },
        actualizaSelect(item){


            if (this.items.length > 0){
                if (this.editedItem.id==0){
                    this.items.push(item);
                }else {

                    var index = this.items.findIndex(o => o.id == item.id);
                    //remplaza item actualizado
                    this.items.splice(index, 1,item);

                }
            }else {
                if (this.editedItem.id==0){
                    this.items_api.push(item);
                }else {

                    var index = this.items_api.findIndex(o => o.id == item.id);
                    //remplaza item actualizado
                    this.items_api.splice(index, 1,item);

                }
            }


            //Cambia el item seleccionado
            this.item = item;


        }
    },
    computed: {
        formTitle () {
            return this.editedItem.id === 0 ? 'Nuevo '+ this.label : 'Editar '+ this.label
        },
        options(){
            if (this.items.length > 0){
                return this.items
            }else {
                return this.items_api;
            }
        }

    },
    watch: {
        item (val) {
            this.$emit('input', val);
        },
        value(val){
            this.item = val;
        }
    }

}
</script>



