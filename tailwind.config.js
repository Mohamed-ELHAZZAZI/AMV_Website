const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                dark: {
                    300: "#282727",
                    400: "#313131",
                    500: "#1f1f1f",
                    600: "#333333",
                },
                second: "#3b82f6",
            },
            inset: {
                "50px": "50px",
            },
            fontSize: {
                "5xs": "4px",
                'xxs': '11px'
            },
            spacing: {
                "133px": "133px",
            },
        },
        screens: {
            'mini-sm': '400px',
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px' 
          },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/typography"),
    ],
};
