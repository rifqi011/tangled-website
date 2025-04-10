import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                black: "#111111",
                purple: "#22177a",
                red: "#ED6A6A",
                green: "#1F7D53",
            },
            boxShadow: {
                navbar: "0px 2px 15px 0px rgba(0, 0, 0, 0.5)",
                card: "0px 0px 5px 3px rgba(0, 0, 0, 0.3)",
            },
            fontFamily: {
                urbanist: ["Urbanist", "sans-serif"],
            },
        },
    },
    plugins: [],
};
