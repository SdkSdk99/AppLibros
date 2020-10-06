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
                <i class="icon-globe"></i> Paises
                    <!-- <button type="button" class="btn btn-secondary btn-dark" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button> -->
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Nombre</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" />
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr> 
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nombre"></td>
                            
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                    <i class="icon-pencil"></i>
                                </button>
                                &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="EliminarPais(objeto)">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Ant</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" :class="{ mostrar: modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titulo"></h4>
                    <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre de categoría" />
                                <span class="help-block">(*) Ingrese el nombre de la
                                    categoría</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="cerrarModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   <!-- /  <button v-show="accion == 0" type="button" @click="RegistrarPais" class="btn btn-primary">Guardar </button>-->
                    <button v-show="accion" type="button" @click="ActualizarPais" class="btn btn-primary">Actualizar</button>
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
                    <h4 class="modal-title">Eliminar Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar la categoría?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="EliminarPais" class="btn btn-danger">Eliminar</button>
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
    data() {
        return {
            arrayDatos: [],
            nombre: "",
            idPais: 0,
            modal: 0,
            accion: 0,
            titulo: ""
        };
    },
    methods: {
        ListarPais: function () {
            let me = this;
            var url = "/pais";
            axios
                .get(url)
                .then(function (response) {
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.pais;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        ActualizarPais() {
            let me = this;
            var url = "/pais/actualizar";
            axios
                .put(url, {
                    id: this.idPais,
                    nombre: this.nombre
                })
                .then(function (response) {
                    me.ListarPais();
                    me.mensaje("¡Se actualizó correctamente!");
                    me.cerrarModal();
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        EliminarPais(data = []) {
            let me = this;
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "¡No, cancélalo!",
                confirmButtonText: "¡Si, bórralo!"
            }).then(result => {
                if (result.isConfirmed) {
                    var url = "/pais/eliminar";
                    axios
                        .post(url, {
                            id: data["id"]
                        })
                        .then(function (response) {
                            me.ListarPais();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    Swal.fire(
                        "¡Eliminado!",
                        "El dato ha sido eliminado.",
                        "success"
                    )
                }
            })
        },
        abrirModal(accion, data = []) {
            switch (accion) {
                case "guardar":
                    this.titulo = "Registrar Pais";
                    this.accion = 0;
                    this.limpiar();

                    break;

                case "editar":
                    this.titulo = "Editar Pais";
                    this.accion = 1;
                    this.idPais = data["id"];
                    this.nombre = data["nombre"];
                    break;

                default:
                    break;
            }

            this.modal = 1;
        },
        cerrarModal() {
            this.modal = 0;
        },
        limpiar() {
            this.nombre = "";
        },

        mensaje(msj) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: msj,
                showConfirmButton: false,
                timer: 2000
            });
        }
    },

    mounted() {
        console.log("Component mounted.");
        this.ListarPais();
    }
};
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
