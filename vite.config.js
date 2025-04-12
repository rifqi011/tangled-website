import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { loadEnv } from "vite";

export default defineConfig(({ mode }) => {
    // Load env file based on mode
    const env = loadEnv(mode, process.cwd());

    // Get host IP from env or use default
    const host = env.VITE_HOST || "localhost";
    const port = parseInt(env.VITE_PORT || "5173");

    // Construct proper origin for CORS
    const appOrigin = `http://${host}:8000`;

    return {
        server: {
            host,
            port,
            strictPort: true,
            cors: {
                origin: appOrigin,
                credentials: true,
            },
        },
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: true,
            }),
        ],
    };
});
