<script >
  import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.svelte";

</script>

<svelte:head>
    <title>Miembros</title>
</svelte:head>

<AuthenticatedLayout>
    
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

          <section>
            <div class="items-center px-8 py-12 mx-auto max-w-7xl lg:px-16 md:px-12">
              <div class="justify-center w-full lg:p-10 max-auto">
                <div class="relative flex flex-wrap">
                  <div class="absolute top-4 left-0 right-0 hidden lg:block h-[1px]">
               
                  </div>
                  <div class="z-10 grid w-full mb-4 lg:gap-8 lg:grid-cols-4">
                    <a href="#section1" class="w-full "><span class="z-10 flex items-center justify-center w-8 h-8 text-white bg-black rounded-full step">1</span>
                      
                    </a>
                    <a href="#section2" class="w-full "><span class="z-10 flex items-center justify-center w-8 h-8 text-white bg-black rounded-full step">2</span>
                      
                    </a>
                    <a href="#section3" class="w-full "><span class="z-10 flex items-center justify-center w-8 h-8 text-white bg-black rounded-full step">3</span>
                      
                    </a>
                    <a href="#section4" class="w-full "><span class="flex items-center justify-center w-8 h-8 text-white bg-black rounded-full">4</span>
                      
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </section>

            <section id="section1" class="w-full p-8 mt-6  rounded shadow bg-gray-100">
              <div class="">
                
                <h1>Pregunta 1</h1>
                <hr class="bg-gray-300 my-12">
                <label for="">Pregunta?</label>
                <input type="text">
              </div>
            </section>
            
            <fieldset id="section2" class="w-full p-8 mt-6 rounded shadow bg-gray-100">
              <h1>Segunda Pregunta</h1>
              <hr class="bg-gray-300 my-12">
              <label for="">Pregunta?</label>
              <input type="text">
            </fieldset>

            <section id="section3" class="w-full p-8 mt-6  rounded shadow bg-gray-100">
              <div class="">
                
                <h1>Pregunta 3</h1>
                <hr class="bg-gray-300 my-12">
                <label for="">Pregunta?</label>
                <input type="text">
              </div>
            </section>
            
            <fieldset id="section4" class="w-full p-8 mt-6 rounded shadow bg-gray-100">
              <h1>Pregunta 4</h1>
              <hr class="bg-gray-300 my-12">
              <label for="">Pregunta?</label>
              <input type="text">
            </fieldset>


          
    </div>
  </div>
</AuthenticatedLayout>


  