import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "192.168.40.170", // pakai IP LAN dari komputermu, bukan `true`
        port: 5173,
        strictPort: true,
        cors: {
            origin: "http://192.168.40.170:8000", // Allow dari Laravel
            credentials: true,
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
