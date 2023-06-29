<script>
  import { page, Link, useForm} from "@inertiajs/svelte";
  import Swal from 'sweetalert2';

  import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.svelte";
  import InputLabel from "../../Components/InputLabel.svelte";
  import TextInput from "../../Components/TextInput.svelte";
  import InputError from "../../Components/InputError.svelte";
  import PrimaryButton from "../../Components/PrimaryButton.svelte";
  
  export let role;
  export let permisos;
 

  let editstatus = false;
  let permisoArray = Object.entries(permisos); 
  //convierte objeto a un arreglo iterable  - toma solo valores
  
  
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
        name: "",
        permisos: [],
        terms: false,
    });

  const submit = () => {
       (!editstatus) ?  createrol() :  updaterol()
      
    };

  const createrol = () => {
    $form.post(window.route("roles.store"), {
            onSuccess: () => {
              Toast.fire({
                icon: 'success',
                title: 'Creado'
              })
            },
            onFinish: () => $form.reset(),

        });
    
  }

  const editrol = (rol) => {
    const permis = rol.permissions.map((e, i) => {return e.id})
    console.log(permis)
    editstatus = true
    $form.name = rol.name
    $form.id = rol.id
    $form.permisos = permis
   
  }

  const updaterol = () => {
    console.log($form.id)
    $form.put(`roles/${$form.id}`),  {
      
      onSuccess: () => {
              Toast.fire({
                icon: 'success',
                title: 'Actualizado'
              })
            },
      onError: (error) => {
        Toast.fire({
                icon: 'error',
                title: 'Algo salio mal'
              })
            },
      onFinish: () => $form.reset(),

    };
  
    editstatus = false;
    
  }

  const destroy = (id) => {
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
                
                        $form.delete(route("roles.destroy", id), {
                          onSuccess: () => {
                            Toast.fire({
                              icon: 'success',
                              title: 'Eliminado'
                            })
                          }
                        })
              
                      }
                  })
    }

  $: console.log($page.props.flag.message)
  
</script>

<svelte:head>
  <title>Roles</title>
</svelte:head>

<AuthenticatedLayout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          
                  
          <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-2 mx-auto grid grid-cols-3 gap-4">
              <div class=" bg-white  col-span-1 ">
                <form on:submit|preventDefault={submit}>
                  <div>
                      <InputLabel for="name" value="Name" />
  
                      <TextInput
                          id="name"
                          type="text"
                          bind:value={$form.name}
                          required
                          autofocus
                          autocomplete="name"
                      />
  
                      <InputError class="mt-2" message={$form.errors.name} />
                  </div>
  
                  <div class="mt-4">
                    <InputLabel for="permiso" value="Permisos" />
                    {#each permisoArray as permiso}
                      <label for="{permiso[1]}" class="w-48 block">
                        <input 
                        type="checkbox" 
                        name="permiso" 
                        id="{permiso[1]}" 
                        bind:group={$form.permisos}
                        value={parseInt(permiso[0])}
                        class="rounded">
                        {permiso[1]}

                      </label>
                    
                    {/each}
                    

                  </div>
  
                  <div class="flex items-center justify-end mt-4">
                                          
                      <PrimaryButton disabled={$form.processing} classes="ml-4">
                        {#if !editstatus}
                           Guardar Rol
                        {:else}
                           Actualizar Rol
                        {/if}
                      </PrimaryButton>
  
                  </div>
                </form>

              </div>
              
              <div class=" rounded-lg overflow-hidden  p-2 col-span-2">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                  <table class="w-full table-fixed text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <th scope="col" class="px-6 py-3">
                                  nombre rol
                              </th>
                              <th scope="col-2" class="px-6 py-3 w-64">
                                  permisos
                              </th>
                              
                              <th scope="col" class="px-6 py-3 text-right">
                                  Action
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                      {#each role as rol}
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {rol.name}
                          </th>
                       
                          <td class="px-6 py-4">
                              {#if (rol.name === 'SuperAdmin')}
                              <span>Todos los permisos</span>
                              {:else}
                              {#each rol.permissions as permiso}
                                <spam class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{permiso.name}</spam>
                              {:else}
                              <span>Sin Permisos</span>
                              {/each}
                              {/if}
                          </td>
                        
                          <td class="px-6 py-4 text-right">
                            {#if $page.props.auth.user_permissions.includes('editar_rol')}
                              <button class="font-medium text-blue-100 dark:text-blue-500" on:click={editrol(rol)}>✏️</button>
                            {/if}
                            
                            {#if $page.props.auth.user_permissions.includes('borrar_rol')}
                               <button class="font-medium text-red-100 dark:text-red-500" on:click={destroy(rol.id)}>🗑️ </button>
                            {/if}
                          </td>
                        </tr>
                      {/each}
                      
                   
                        
                     
                       
                      </tbody>
                  </table>
                </div>
              </div>
                    
         
             
            </div>
          </section>
          <!-- table -->
         
    </div>
  </div>
</AuthenticatedLayout>
