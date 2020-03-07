<template>
<div>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Cursos</div>
          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Agregar Curso
                </button></div>
                <div class="col-md-6">
                  <h1>Total : {{courses.length}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Estudiantes</div>
          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1>Total : 10</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Docentes</div>
          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1>Total :3</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Cursos</div>
          <div class="card-body">
            <div class="container">
              <table class="table">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descrición</th>
                  <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                  <tr  v-for="(couse, index) in courses" :key="index">
                    <th scope="row">{{index}}</th>
                    <td>{{couse.name}}</td>
                    <td>{{couse.description}}</td>
                    <td>
                      <button @click="editCourse(couse)" class="btn btn-warning btn-sm">Editar</button>
                      <button @click="deleteCourse(couse, index)" class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--MODAL-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form v-on:submit.prevent="saveCourse">
          <div class="modal-body">
              <div class="form-group">
                <label for="name">Nombre del Curso</label>
                <input type="text" class="form-control"  v-model="course.name" id="name" aria-describedby="emailHelp" placeholder="Nombre del curso">
              </div>
              <div class="form-group">
                <label for="description">Descripción del Curso</label>
                <textarea name="description" id="description"  v-model="course.description" class="form-control" style="resize: none"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Agregar Curso</button>
          </div>
       </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editarCourse" tabindex="-1" role="dialog" aria-labelledby="editarNotaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarNotaLabel">Editar Nota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="udpdateCourse(course)">
            <label for="nombre">Nombre de Curso</label>
            <input type="text" class="form-control" id="nombre" v-model="course.name" placeholder="Nombre del curso">
            <label for="description">Descripcion del Curso</label>
            <textarea name="description" v-model="course.description" class="form-control" style="resize: none"></textarea>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Atualizar Curso</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                courses: [],
                course: {
                    name: '',
                    description: ''
                },
                formEditar: false,
            }
        },

        created() {
            this.getData();
        },
        mounted() {
            console.log('Component mounted.');
            this.getData();
        },
        methods: {
            getData() {
                axios.get('/cursos').then(res => {
                    let datos = this.courses = res.data;
                    datos.sort();
                })
            },
            saveCourse() {
                let url = ('/cursos/crear');
                const parametros = {
                    name: this.course.name,
                    description: this.course.description
                };
                this.course.name = '',
                    this.course.description = '',
                    $('#exampleModal').modal('hide');
                axios.post(url, parametros).then(res => {
                    alert('El registro se agrego con exito')
                    this.courses.push(res.data).sort(res.data)
                }).catch(function (error) {
                    console.log(error);
                })
            },

            editCourse(item) {
                $('#editarCourse').modal('show');
                this.formEditar = true;
                this.course.name = item.name;
                this.course.description = item.description;
                this.course.id = item.id;
            },

            udpdateCourse(course) {
                const parametros = {
                    name: this.course.name,
                    description: this.course.description
                };
                this.formEditar = false;
                this.course.name = '';
                this.course.description = '';
                axios.put(`/cursos/update/${course.id}`, parametros).then((res) => {
                    //buscar index
                    const index = this.courses.findIndex(item => item.id === course.id)
                    this.courses[index] = res.data;
                    $('#editarCourse').modal('hide');
                    axios.get('/cursos').then(res => {
                        let datos = this.courses = res.data;
                        datos.sort();
                    })
                })
            },

            deleteCourse(course, index) {
                const confirmacion = confirm(`Eliminar nota ${course.name}`);
                if (confirmacion) {
                    axios.delete(`/cursos/${course.id}`)
                    .then(() => {
                        this.courses.splice(index, 1);
                    })
                }
            }
        }
    }
</script>
<style>
  .visible{
    display:block;
  }
</style>