<!-- <script context="module">
    export {default as layout} from "../../Layouts/AuthenticatedLayout.svelte";
    
</script> -->

<script>
    import { page, Link, useForm } from "@inertiajs/svelte";
    import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.svelte";
    import Swal from 'sweetalert2';
    import { prevent_default } from "svelte/internal";
    export let usuario;
  
    //console.log(JSON.stringify(usuario.roles[0]));
   // console.log($page.props)

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const form = useForm({
        terms: false,
    });

    const destroy = (id) => {
    if ($page.props.auth.user.id !== id) 
        {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
        
                    $form.delete(route("usuarios.destroy", id), {
                    onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Eliminado'
                            })
                        }
                    })
        
                }
            })
        } else {

            Toast.fire({
                icon: 'warning',
                title: 'El mismo Usuario NO se puede Eliminar!!'
            })
        }
    };
    
</script>

<svelte:head>
    <title>Usuarios</title>
</svelte:head>


<AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
          <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            
            <div class="flex items-center gap-4 mb-2">
                <Link
                        href={window.route("register")}
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        >Registrar Usuario</Link>
                 

                
            </div>
            
            <!-- table -->
           <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                      <tr>
                          <th scope="col" class="px-6 py-3">
                              nombre usuario
                          </th>
                          <th scope="col" class="px-6 py-3">
                              email
                          </th>
                          <th scope="col" class="px-6 py-3">
                              rol
                          </th>
                          <th scope="col" class="px-6 py-3">
                              Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                    {#each usuario as users}
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {users.name}
                        </th>
                        <td class="px-6 py-4">
                           {users.email}
                        </td>
                        <td class="px-6 py-4">
                            {#each users.roles as rol}
                                <spam class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{rol.name}</spam>
                            {/each}
                            
                        </td>
                        
                        <td class="px-6 py-4">
                        
                        <form on:submit|preventDefault></form>

                        <a href={window.route('usuarios.editar', users.id)} class="font-medium text-blue-100 dark:text-blue-500">✏️</a>
                       
                        <button class="font-medium text-red-100 dark:text-red-500" on:click={destroy(users.id)}>🗑️</button>
                                       
                     </td>
                    </tr>
                    {/each}
                    
                 
                   
                  </tbody>
              </table>
            </div>
    
          
          </div>
      </div>
    </div>
</AuthenticatedLayout>
