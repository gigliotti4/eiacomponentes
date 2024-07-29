@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
  <div class="section-header d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bienvenido {{Auth::user()->name}}</h1>
  </div>

  <div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <h1 class="">Nota de Explicación: Gestión de Recursos en el Sistema</h1>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h3>Crear Recursos</h3>
                <ul>
                    <li>
                        <strong>Acceder a la Sección de Gestión de Recursos:</strong>
                        <ul>
                            <li>Desde el panel de navegación, selecciona la categoría correspondiente al recurso que deseas gestionar (por ejemplo, "Clientes", "Productos", etc.).</li>
                            <li>Haz clic en "Crear nuevo recurso" en el submenú.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Rellenar el Formulario de Creación:</strong>
                        <ul>
                            <li>Completa los campos necesarios en el formulario, como el nombre, la descripción, y cualquier otra información relevante.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Guardar el Recurso:</strong>
                        <ul>
                            <li>Haz clic en el botón "Guardar" para crear el nuevo recurso. El sistema te notificará si la creación ha sido exitosa.</li>
                        </ul>
                    </li>
                </ul>
        
                <hr>
        
                <h3>Leer Recursos</h3>
                <ul>
                    <li>
                        <strong>Acceder a la Lista de Recursos:</strong>
                        <ul>
                            <li>Desde el panel de navegación, selecciona la categoría del recurso que deseas ver.</li>
                            <li>La lista mostrará todos los recursos disponibles en esa categoría.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Visualizar Detalles:</strong>
                        <ul>
                            <li>Haz clic en el nombre o en un enlace asociado al recurso para ver más detalles.</li>
                        </ul>
                    </li>
                </ul>
        
                <hr>
        
                <h3>Actualizar Recursos</h3>
                <ul>
                    <li>
                        <strong>Acceder a la Lista de Recursos:</strong>
                        <ul>
                            <li>Desde el panel de navegación, selecciona la categoría del recurso.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Seleccionar el Recurso a Editar:</strong>
                        <ul>
                            <li>Haz clic en el botón "Editar" junto al recurso que deseas modificar.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Actualizar la Información del Recurso:</strong>
                        <ul>
                            <li>Modifica los campos necesarios en el formulario de edición.</li>
                            <li>Haz clic en "Actualizar" para guardar los cambios. El sistema te notificará si la actualización ha sido exitosa.</li>
                        </ul>
                    </li>
                </ul>
        
                <hr>
        
                <h3>Eliminar Recursos</h3>
                <ul>
                    <li>
                        <strong>Acceder a la Lista de Recursos:</strong>
                        <ul>
                            <li>Desde el panel de navegación, selecciona la categoría del recurso.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Seleccionar el Recurso a Eliminar:</strong>
                        <ul>
                            <li>Haz clic en el botón "Eliminar" junto al recurso que deseas eliminar.</li>
                            <li>Confirma la eliminación cuando el sistema te lo solicite. El sistema te notificará si la eliminación ha sido exitosa.</li>
                        </ul>
                    </li>
                </ul>
        
                <hr>
                <h3>Conclusión</h3>
                <p>La gestión de recursos es una parte esencial de tu rol como administrador. Utilizando las funciones de creación, lectura, actualización y eliminación de recursos, puedes mantener el sistema seguro y eficiente.</p>
        
                <p>Espero que esta guía te sea útil para realizar tus tareas de administración de manera efectiva.</p>
            </div></div>
            </div>
            {{-- <div class="col-auto">
              <i class="fa-solid fa-box-open text-primary fa-2x stat"></i>
            </div> --}}
          </div>
        </div>
      </div>
      </div>
      {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">Usuarios</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$usuarios}}</div>
              </div>
              <div class="col-auto">
                <i class="fa-solid fa-user text-primary fa-2x stat"></i>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                  Novedades
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{@$novedades}}
                </div>
              </div>
              <div class="col-auto">
                <i class="fa-regular fa-newspaper text-primary fa-2x stat"></i>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
</div>

@endsection