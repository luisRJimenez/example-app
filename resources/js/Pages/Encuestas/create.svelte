<script context="module">
  //export { default as layout } from "../../Layouts/GuestLayout.svelte";
 export { default as layout } from "../../Layouts/AuthenticatedLayout.svelte";

 
</script>

<script>

  import { Link, useForm, router } from "@inertiajs/svelte";
  import InputLabel from "../../Components/InputLabel.svelte";
  import TextInput from "../../Components/TextInput.svelte";
  import InputError from "../../Components/InputError.svelte";
  import PrimaryButton from "../../Components/PrimaryButton.svelte";
  import SecondaryButton from "@/Components/SecondaryButton.svelte";

  let todos = [];
  

  const form = useForm({
      name: "",
      email: "",
      password: "",
      miembros: [{
        
        nom_miembro:"",
        ape_miembro:"",
      
    }],
      terms: false,
  });

  const addMiembro = () =>{
      $form.miembros = [...$form.miembros, {
        
        nom_miembro:"",
        ape_miembro:"",
      
    }]
  }

  if (localStorage.getItem("todos")){
    todos = JSON.parse(localStorage.getItem("todos"))
  }

  $: localStorage.setItem("todos", JSON.stringify(todos))

  const submit = () => {
     
      todos = [...todos, $form]
      $form.reset()
      console.log(todos)
  };

  // Inertia Version Anterior
  // const sincronizar = () => {
  //   let data = JSON.stringify(todos);
  //   Inertia.post(window.route('encuestas.create'), {
  //     data,
  //   })
  // }

  // Inertia version Nueva
  const sincronizar = () => {
   let url = `/encuestas/crear`;
   let data = JSON.stringify(todos);
   
   //console.log(data.filter(i => i.email === "luis.jimenezb@cun.edu.co"))
   router.post(url, {
     data }, {
     onSuccess: () => console.log('response')
   });
   console.log('sincroinizar')
   let file = new Blob([data], { type: 'application/json' });
   let f = new Date();
   let fileName = `encuenstas_${f.getDate()}-${f.getMonth()+1}-${f.getFullYear()}-${f.getHours()}-${f.getMinutes()}-${f.getSeconds()}`;

   let  downloadLink = document.createElement('a');
        downloadLink.href = URL.createObjectURL(file);
        downloadLink.download = fileName;

        downloadLink.click();
  }
  
  export let phpVersion;
</script>

<svelte:head>
  <title>Register</title>
</svelte:head>

<pre>{JSON.stringify($form, null, 2)}</pre>

datos_{phpVersion}
<pre>Encuestas a sincroinizar: {JSON.stringify(todos.length)}</pre>


<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <form on:submit|preventDefault={submit}>
              <div>
                  <InputLabel for="name" value="Name" classes/>

                  <TextInput
                      id="name"
                      type="text"
                      bind:value={$form.name}
                      required
                      autofocus
                      autocomplete="name"
                  />

                  <InputError  message={$form.errors.name} />
              </div>

              <div class="mt-4">
                  <InputLabel for="email" value="Email" classes/>

                  <TextInput
                      id="email"
                      type="email"
                      bind:value={$form.email}
                      required
                      autocomplete="email"
                  />

                  <InputError  message={$form.errors.email} />
              </div>

              <div class="mt-4">
                  <InputLabel for="password" value="Password" classes />

                  <TextInput
                      id="password"
                      type="password"
                      bind:value={$form.password}
                      required
                      autocomplete="new-password"
                  />

                  <InputError  message={$form.errors.password} />
              </div>
     

              {#each $form.miembros as miembro, i }
                 <!-- content here -->
                 <div>
                   <input type="text" name="nombremiembro" id="nombremiembro{i}" bind:value={miembro.nom_miembro}>
                 </div>
                 <div>
                   <input type="text" name="apemiembro" id="apemiembro{i}" bind:value={miembro.ape_miembro}>
                 </div>
              {/each}
             

              <div class="flex items-center justify-end mt-4">
                  
               
                <Link href={window.route("miembros.index")} >Adgregar Miembros</Link>
                  <PrimaryButton disabled={$form.processing} classes="ml-4">
                      Register
                  </PrimaryButton>

                  <SecondaryButton onClick={sincronizar}  classes="ml-4">
                    Sincronizar con BD
                  </SecondaryButton>

              </div>

          </form>
      </div>
  </div>
</div>