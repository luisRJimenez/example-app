<script >
  import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.svelte";
  import { Link } from "@inertiajs/svelte";

  export let phpVersion ="";
</script>

<svelte:head>
    <title>Encuestas</title>
</svelte:head>

<AuthenticatedLayout>
    Version_{phpVersion}
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          
          <div class="flex items-center gap-4 mb-2">
              <Link
                      href={window.route("encuestas.create")}
                      class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                      >Crear Encuesta</Link>
               

              
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
                  <!-- {#each usuario as users} -->
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       fasfafaf
                      </th>
                      <td class="px-6 py-4">
                         dadsfafaf
                      </td>
                      <td class="px-6 py-4">
                          dsfafafa
                          
                      </td>
                      
                      <td class="px-6 py-4">
                      
                      <form on:submit|preventDefault></form>

                      <button class="font-medium text-blue-100 dark:text-blue-500">✏️</button>
                     
                      <button class="font-medium text-red-100 dark:text-red-500" >🗑️</button>
                                     
                   </td>
                  </tr>
                  <!-- {/each} -->
                  
               
                 
                </tbody>
            </table>
          </div>
  
        
        </div>
    </div>
  </div>
</AuthenticatedLayout>
  
