<script context="module">
   // context="module"
    export { default as layout } from "../Layouts/AuthenticatedLayout.svelte";
    //import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.svelte";
    
</script>

<script>export let phpVersion;</script>

<svelte:head>
    <title>Dashboard</title>
</svelte:head>

<!-- <AuthenticatedLayout> -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            >
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You're logged in!
                    {phpVersion}
                </div>
            </div>
        </div>
    </div>
<!-- </AuthenticatedLayout> -->
