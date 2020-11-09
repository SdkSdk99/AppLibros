<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>            
    <div class="container-fluid" >
        
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user-secret"></i> Libro
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Agregar
                </button>
            </div>            
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                            <option value="nombre">Nombre</option>
                            </select>
                            <input type="text" id="texto" name="texto" v-model="buscar" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>                                   
                            <th>Código</th>                                   
                            <th>Cantidad</th>                                   
                            <th>Año publicación</th>                                   
                            <th>num_pag</th>                                   
                            <th>Ubicación</th>                                   
                            <th>Edición</th>                                   
                            <th>Editorial</th>                                   
                            <th>Categoria</th>                                   
                            <th>Autor</th>                                   
                            <th>Idioma</th>                                   
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nombre"></td>
                            <td v-text="objeto.codigo"></td>
                            <td v-text="objeto.cant"></td>
                            <td v-text="objeto.ano_publi"></td>
                            <td v-text="objeto.num_pag"></td>
                            <td v-text="objeto.ubicacion"></td>
                            <td v-text="objeto.edicion"></td>
                            <td v-text="objeto.nomEdi"></td>
                            <td v-text="objeto.nomCat"></td>
                            <td v-text="objeto.nomAut"></td>
                            <td v-text="objeto.nomIdi"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarLibro(objeto)">
                                <i class="icon-trash"></i>
                                </button>
                            </td>                                                                        
                        </tr>                                                                                                                                
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)" >Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link"  href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titulo">Agregar Libro</h4>
                    <button type="button" class="close" @click="cerrarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Nombre</label>                            
                            <div class="col-md-5">
                                <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre">
                            </div>
                            <label class="col-md-1 form-control-label" for="text-input">Código</label>                            
                            <div class="col-md-5">
                                <input type="text" v-model="codigo" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el código">
                            </div>                            
                        </div>
                        <div class="form-group row">                            
                            <label class="col-md-1 form-control-label" for="text-input">Cantidad</label>                            
                            <div class="col-md-5">
                                <input type="text" v-model="cant" id="cant" name="cant" class="form-control" placeholder="Ingrese la cantidad">
                            </div>
                            <label class="col-md-1 form-control-label" for="text-input">Año public</label>                            
                            <div class="col-md-5">
                                <input type="date" v-model="ano_publi" id="ano_publi" name="ano_publi" class="form-control" placeholder="Ingrese año publicación">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Número páginas</label>                            
                            <div class="col-md-5">
                                <input type="text" v-model="num_pag" id="num_pag" name="num_pag" class="form-control" placeholder="Ingrese Número de páginas">
                            </div>
                            <label class="col-md-1 form-control-label" for="text-input">Ubicación</label>                            
                            <div class="col-md-5">
                                <input type="text" v-model="ubicacion" id="ubicacion" name="ubicacion" class="form-control" placeholder="Ingrese la ubicación">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Edición</label>                            
                            <div class="col-md-5">
                                <input type="text" v-model="edicion" id="edicion" name="edicion" class="form-control" placeholder="Ingrese la edición">
                            </div>
                            <label class="col-md-1 form-control-label" for="text-input">Editorial</label>
                            <div class="col-md-5">
                                <select class="form-control" v-model="id_editorial" id="exampleFormControlSelect1">
                                    <option v-for="objeto in arrayEditorial" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre"></option>
                                </select>
                                <span class="help-block">(*) Seleccione el editorial</span>
                            </div> 
                        </div>
                        <div class="form-group row"> 
                            <label class="col-md-1 form-control-label" for="text-input">Categoria</label>
                            <div class="col-md-5">
                                <select class="form-control" v-model="id_categoria" id="exampleFormControlSelect2">
                                    <option v-for="objeto in arrayCategoria" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre"></option>
                                </select>
                                <span class="help-block">(*) Seleccione la categoria</span>
                            </div>
                            <label class="col-md-1 form-control-label" for="text-input">Autor</label>
                            <div class="col-md-5">
                                <select class="form-control" v-model="id_autor" id="exampleFormControlSelect3">
                                    <option v-for="objeto in arrayAutor" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre"></option>
                                </select>
                                <span class="help-block">(*) Seleccione el autor</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 form-control-label" for="text-input">Idioma</label>
                            <div class="col-md-5">
                                <select class="form-control" v-model="id_idioma" id="exampleFormControlSelect4">
                                    <option v-for="objeto in arrayIdioma" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre"></option>
                                </select>
                                <span class="help-block">(*) Seleccione el idioma</span>
                            </div>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regLibro" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actLibro" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Libro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el Libro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarLibro" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Fin del modal Eliminar -->
</main>
</template>

<script>
    export default {


        data(){
            return{
                arrayDatos:[],
                nombre:'',
                codigo:'',
                cant:'',
                ano_publi:'',
                num_pag:'',
                ubicacion:'',
                edicion:'',
                id_editorial:'',
                id_categoria:'',
                id_autor:'',
                id_idioma:'',
                idLib:'',
                modal:'',
                titulo:'',
                accion:0,
                //llave foranea
                arrayEditorial:[],
                id_editorial:0,
                arrayCategoria:[],
                id_categoria:0,
                arrayAutor:[],
                id_autor:0,
                arrayIdioma:[],
                id_idioma:0,
                //paguinacion
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0,
                },
                offset:3,
                buscar:'',
                criterio:'nombre'
            }
        },

        methods: {
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //va a la pagina actual
                me.pagination.current_page = page;
                //envia al metodo para traer los datos
                me.listLibro(page,criterio,buscar);
            },
            
            listLibro:function(page,criterio,buscar){
                let me = this;
                var url = "/libro?page="+ page+ '&criterio='+criterio+ '&buscar='+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.libros.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getEditoriales(){
                let me = this;
                var url = "/selectEditorial";
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayEditorial = respuesta.editoriales;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            getCategorias(){
                let me = this;
                var url = "/selectCategoria";
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            getAutores(){
                let me = this;
                var url = "/selectAutor";
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayAutor = respuesta.autores;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            getIdiomas(){
                let me = this;
                var url = "/selectIdioma";
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayIdioma = respuesta.idiomas;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            regLibro(){
                let me = this;
                var url = "/libro/registrar";
                axios.post(url,{
                    nombre: this.nombre,
                    codigo: this.codigo,
                    cant: this.cant,
                    ano_publi: this.ano_publi,
                    num_pag: this.num_pag,
                    ubicacion: this.ubicacion,
                    edicion: this.edicion,
                    id_editorial:this.id_editorial,
                    id_categoria:this.id_categoria,
                    id_autor:this.id_autor,
                    id_idioma:this.id_idioma,
                })
                .then(function(response){
                    me.listLibro();
                    me.mensaje('Se guardo correctamente');  
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });  
            },
            actLibro(){
	            let me = this;
                var url="/libro/actualizar";
                axios.put(url,{
                    id:this.idLib,
                    nombre: this.nombre,
                    codigo: this.codigo,
                    cant: this.cant,
                    ano_publi: this.ano_publi,
                    num_pag: this.num_pag,
                    ubicacion: this.ubicacion,
                    edicion: this.edicion,
                    id_editorial:this.id_editorial,
                    id_categoria:this.id_categoria,
                    id_autor:this.id_autor,
                    id_idioma:this.id_idioma,
                })
                .then(function(response){
                    me.listLibro();
                    me.mensaje('Se actualizo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            abrirModal(accion,data=[]){
                switch(accion){
                    case'guardar':
                        this.titulo = 'Registrar Libro';
                        this.accion = 0;
                        this.limpiar();
                        break;
                    case 'editar':
                        this.titulo = 'Editar Libro';
                        this.accion = 1;
                        this.idLib = data['id'];
                        this.nombre = data['nombre'];
                        this.codigo = data['codigo'];
                        this.cant = data['cant'];
                        this.ano_publi = data['ano_publi'];
                        this.num_pag = data['num_pag'];
                        this.ubicacion = data['ubicacion'];
                        this.edicion = data['edicion'];
                        this.id_editorial = data["id"];
                        this.id_categoria = data["id"];
                        this.id_autor = data["id"];
                        this.id_idioma = data["id"];
                        break;
                    default:
                        break;
                }
                this.modal = 1;
            },            
            cerrarModal(){
                this.modal = 0;
            },
            limpiar(){
                this.nombre ='';            
                this.codigo ='';
                this.cant = 
                this.ano_publi ='';
                this.num_pag ='';
                this.ubicacion ='';
                this.edicion ='';
                this.id_editorial ='';
                this.id_categoria ='';
                this.id_autor ='';
                this.id_idioma ='';           
            },
            mensaje(msj){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msj,
                    showConfirmButton: false,
                    timer: 1500
                })
            },            
            eliminarLibro(data=[]){
                let me = this;
                Swal.fire({
                    title: 'Esta seguro de eliminarlo?',
                    text: "No podrás revertir esto!"+data['nombre'],
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, eliminar!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        var url="/libro/eliminar";
                        axios.post(url,{
                        id:data['id']
                        })
                        .then(function(response){
                            me.listLibro();
                        })
                        .catch(function(error){
                        console.log(error);
                        });
                    }
                })
            },
            
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
            this.getEditoriales();         
            this.getCategorias();         
            this.getAutores();         
            this.getIdiomas();         
            this.listLibro(1,this.criterio,this.buscar);
        }
    }
</script>

<style>

.modal-content{
    width: 100% !important;
    position: absolute  !important;;
}
.mostrar{
    display:list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color:#9995957a; 
}

</style>