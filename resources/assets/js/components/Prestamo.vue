<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                  <h6> <i class="fa fas fa-bookmark"></i> Prestamo de libros</h6> 
                </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Persona</label>
                                <div class="col-md-5">
                                    <select class="form-control" v-model="id_persona" id="exampleFormControlSelect1">
                                        <option v-for="objeto in arrayPersona" :key="objeto.id" :value="objeto.id" v-text="objeto.nomCom"></option>
                                    </select>
                                </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Entrega</label>
                                    <div class="col-md-5">
                                        <input type="date" v-model="fec_entrega" id="fec_entrega" name="fec_entrega" class="form-control"
                                            placeholder="Código" />
                                    </div>
                                </div> 
                            <div class="form-group row">
                                    <label class="col-md-1 form-control-label" for="text-input">Libros</label>
                                    <div class="col-md-5">
                                    <div class="input-group">
                                        <input class="form-control col-12"  v-model="buscar2"  placeholder="Texto a buscar" type="text" @keyup="GetLibro(buscar2)" />
                                        <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                                            <i class="fa fa-search"></i></button>                                         
                                        </div>
                                    </div>
                                    <h6 class=" col-md-2 text-muted ms-sm-3" v-text="nomLibro">Libros</h6>
                                    <label class="col-md-1 form-control-label" for="text-input">Cantidad </label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input v-model="cant" type="number" id="texto" name="texto"  class="form-control" placeholder="Cantidad de libros" />
                                            <button type="button" class="btn btn-success" @click="AgregarItem2" >
                                            <i class="icon-check"></i></button>                                         
                                        </div>
                                    </div>
                            </div>                         
                        </form>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Cantidad</th>
                                <th>Nombre</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                <td v-text="objeto.codigo"></td>
                                <td v-text="objeto.cant"></td>
                                <td v-text="objeto.nombre"></td>
                                <td v-text="objeto.autor"></td>
                                <td v-text="objeto.edit"></td>
                                <td>            
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="EliminarSolicitud(objeto)">
                                        <i class="icon-trash"></i>
                                    </button>
                                &nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <div class="float-right">
                    <button type="button"  class="btn btn-primary" data-toggle="modal" @click="regSol()"> 
                    &nbsp; Guardar
                    </button>
                    
                </div>
                </div>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina1(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"
                                :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina1(page,buscar,criterio)"
                                    v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina1(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
            </div>
            
            <!-- Fin ejemplo de tabla Listado -->
            </div>          
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" id="modalNuevo" :class="{ mostrar: modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" >Listado de libros</h4>
                        <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" id="texto" name="texto" v-model="buscar" class="form-control"
                                            placeholder="Lib a buscar" @keypress="ListarLibro(1,buscar)"/>
                                        <button type="button" @click="ListarLibro(1,buscar)"  class="btn btn-primary">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Cantidad </label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input v-model="cant" type="number" id="texto" name="texto"  class="form-control" placeholder="Cantidad de libros" />
                                            <button type="button" class="btn btn-success" @click="AgregarItem2" >
                                            <i class="icon-check"></i></button>                                         
                                        </div>
                                    </div>
                            </div>
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                    <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Autor</th>
                                        <th>Editorial</th>
                                        <th>Disponible</th>
                                        <th>Selecionar</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr v-for="objeto in arrayLibros" :key="objeto.id">
                                            <td v-text="objeto.codigo"></td>
                                            <td v-text="objeto.nombre"></td>
                                            <td v-text="objeto.nomAut"></td>
                                            <td v-text="objeto.nomEdi"></td>
                                            <td v-text="objeto.cant"></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" @click="AgregarItem(objeto)">
                                                    <i class="fa fa-mouse-pointer"></i> </button>
                                            </td> 
                                        <tr/>
                                    </tbody>
                            </table>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"
                                :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)"
                                    v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div> 
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </div> 
        <!-- Inicio del modal Eliminar -->
</div> 
        <!-- Fin del modal Eliminar -->
    </main>
</template>

<script>
// import Toasted from 'vue-toasted';
// Vue.use(Toasted)
    export default {
        data() {
            return {
                arrayDatos: [],
                arrayLibros: [],
                arrayGetLibro: [],
                arrayPersona:[],
                fec_entrega:"",
                modal: 0,
                nomLibro:"",
                codLibro:"",
                cant:0,
                titulo:"",
                idLibro:"",
                id_persona:"",
                buscar:"",
                buscar2:"",
                pagination: {
                    total: 0,
                    current_page: 0,
                    per_page: 0,
                    last_page: 0,
                    from: 0,
                    to: 0,
                },
            offset: 3,
            criterio:""
        }
    },
        methods: {
            cambiarPagina(page, buscar) {
                let me = this;
                //Va a la pagina actual
                me.pagination.current_page = page;
                //metodo para traer los datos
                me.ListarLibro(page, buscar);
            },
            cambiarPagina1(page, buscar) {
                let me = this;
                //Va a la pagina actual
                me.pagination.current_page = page;
                //metodo para traer los datos
                me.ListarLibro(page, buscar);
            },
            
            AgregarItem: function(data=[]) {
                this.arrayDatos.push({
                    id:data['id'],
                    codigo:data['codigo'],
                    cant:this.cant,
                    nombre:data['nombre'],
                    autor:data['nomAut'],
                    edit:data['nomEdi']});
                this.arrayLibros.splice(0,1);
                this.mensajeToast();
            },
            AgregarItem2: function() {
                this.arrayDatos.push({
                    id:this.idLibro,
                    codigo:this.codLibro,
                    cant:this.cant,
                    nombre:this.nomLibro,
                    autor:this.nomAut,
                    edit:this.nomEdi});
                this.arrayLibros.splice(0,1);
            },
            ListarLibro: function(page, buscar) {
                let me = this;
                var url = "/libro?page=" + page + '&buscar=' + buscar;
                axios
                    .get(url)
                    .then(function(response) {
                        var respuesta = response.data;
                        me.arrayLibros = respuesta.libros.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function(error) {
                        console.log(error);
                    }); 
            },
            GetLibro: function(buscar2) {
                let me = this;
                var url = "/GetLibro?buscar=" + buscar2;
                    axios
                    .get(url)
                    .then(function(response) {
                        var respuesta = response.data;
                        me.arrayGetLibro = respuesta.libros;

                        if (me.arrayGetLibro.length > 0) {
                            me.idLibro = me.arrayGetLibro[0]['id'];
                            me.codLibro = me.arrayGetLibro[0]['codigo'];
                            me.nomLibro = me.arrayGetLibro[0]['nombre'];
                            me.nomAut   = me.arrayGetLibro[0]['nomAut'];
                            me.nomEdi  = me.arrayGetLibro[0]['nomEdi'];
                            
                        }else{
                            me.nomLibro="Verifique el nombre o código";
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    }); 
            },
            getPersonas() {
            let me = this
            var url = '/selectPersona'
            axios
                .get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayPersona = respuesta.personas;
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            regSol() {
                let me = this;
                var url = "/solicitud/registrar";
                axios.post(url, {
                        fec_entrega:this.fec_entrega,
                        id_persona:this.id_persona,
                        data:me.arrayDatos                        
                    })
                    .then(function(response) {
                        
                        me.mensaje("¡Se guardó correctamente!");
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            
            abrirModal:function () {
                this.modal=1;
                this.titulo="Seleccione un libro";
            },
            cerrarModal() {
                this.modal = 0;
                this.titulo="";
            },
            limpiar() {
                this.fec_entrega = "";
            },
            mensaje(msj) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: msj,
                    showConfirmButton: false,
                    timer: 2000
                });
            },
            mensajeToast(){
                let toast= this.$toasted.show(
                    'Libro agregado',{
                        theme:"bubble"
                    
                });
            }
            
        },
            computed: {
            isActived: function() {
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + this.offset * 2;
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
            mounted() {
        console.log('Component mounted.')
        this.getPersonas();
        this.ListarLibro(1, this.buscar);
        // this.ListarAutores(1, this.criterio, this.buscar)
    },
}

</script> 

<style>
    .modal-content {
        width: 100% !important;
        position: absolute;
    }

    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #bbb4b47a;
    }

</style>
