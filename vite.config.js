import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { svelte } from "@sveltejs/vite-plugin-svelte";


export default defineConfig({
    
    plugins: [
        
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        svelte({
            compilerOptions: {
                hydratable: true,
            },
        }),
        
    ],
    server: {
        
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true
        },
        // proxy: {
        //     '/': {
        //       target: 'https://example-app-production.up.railway.app',
        //       changeOrigin: true,
        //     },
        //   },
    },
});
