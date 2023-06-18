<script context="module">
    //export { default as layout } from "../../Layouts/GuestLayout.svelte";
    export { default as layout } from "../../Layouts/AuthenticatedLayout.svelte";
</script>

<script>
    import { Link, useForm } from "@inertiajs/svelte";
    import InputLabel from "../../Components/InputLabel.svelte";
    import TextInput from "../../Components/TextInput.svelte";
    import InputError from "../../Components/InputError.svelte";
    import PrimaryButton from "../../Components/PrimaryButton.svelte";
  
    const roles = [
       { id: 1, namerol: 'SuperAdmin'} ,
       { id: 2, namerol: 'Subdirector'},
       { id: 3, namerol: 'Estadista'},
       { id: 4, namerol: 'Critico'},
       { id: 5, namerol: 'Coordinador'},
       { id: 6, namerol: 'Empadronador'},
       { id: 7, namerol: 'Digitador'},
]

       
    console.log(roles[0])
    
    let scope = roles[0];

    const form = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        rol: 0,
        terms: false,
    });

    const submit = () => {
        $form.post(window.route("register"), {
            onFinish: () => $form.reset("password", "password_confirmation"),
        });
    };

   // $: console.log(JSON.stringify($form))
</script>

<svelte:head>
    <title>Register</title>
</svelte:head>

<!-- <pre>{JSON.stringify($form)}</pre> -->
<h1>Preba 2</h1>
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

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" classes/>

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        bind:value={$form.password_confirmation}
                        required
                        autocomplete="new-password"
                    />

                    <InputError message={$form.errors.password_confirmation} />
                </div>

                <div class="mt-4">
                    <InputLabel value="Rol" classes/>

                    {#each roles as role}
                  
                    <InputLabel classes="w-48 flex items-center mb-2"> 
                        <input
                            
                            name="roles"
                            bind:group={$form.rol}
                            type="radio"
                            value={role.id}                              
                            required
                            
                            class="w-4 mr-2"
                        />{role.namerol} </InputLabel>
                   
                    {/each}
                    <pre>{$form.rol}</pre>
                    <InputError  message={$form.errors.rol} />
                </div>
            

                <div class="flex items-center justify-end mt-4">
                    <Link
                        href={window.route("login")}
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Already registered?
                    </Link>
                   
                    <PrimaryButton disabled={$form.processing} classes="ml-4">
                        Register 1
                    </PrimaryButton>

                </div>
            </form>
        </div>
    </div>
</div>