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
      terms: false,
  });

  if (localStorage.getItem("todos")){
    todos = JSON.parse(localStorage.getItem("todos"))
  }

  $: localStorage.setItem("todos", JSON.stringify(todos))

  const submit = () => {
     
      todos = [...todos, $form]
      $form.reset()
      console.log(todos)
  };

  const sincroinizar = () => {
   let url = `/roles/sync`;
   let data = JSON.stringify(todos);
   router.put(url, {
     data }, {
     onSuccess: () => console.log(data)
   });
   console.log('sincroinizar')
  }


</script>

<svelte:head>
  <title>Register</title>
</svelte:head>

<pre>{JSON.stringify($form)}</pre>
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
     

              <div class="flex items-center justify-end mt-4">
                  
                 
                  <PrimaryButton disabled={$form.processing} classes="ml-4">
                      Register
                  </PrimaryButton>

                  <SecondaryButton onClick={sincroinizar}  classes="ml-4">
                    Sincronizar con BD
                  </SecondaryButton>

              </div>
          </form>
      </div>
  </div>
</div>