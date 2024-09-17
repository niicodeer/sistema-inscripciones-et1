/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'primary-color': "#EA9010",
                'text-title': "#202020",
            },
        },
    },
    plugins: [
        function({ addUtilities }) {
            const newUtilities = {
                '.btn': {
                    padding: '1rem',
                    fontSize: '1rem',
                    fontWeight: '700',
                    maxWidth: '20rem',
                    width: '100%',
                    borderRadius: '0.375rem',
                    transition: 'background-color 0.3s ease, transform 0.3s ease',
                    boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
                    cursor:'pointer',
                    textAlign:'center',
                    margin:'4px 0px',
                    border:'1px solid rgb(107 114 128)'
                },
                '.btn:hover': {
                    backgroundColor: 'rgba(234, 144, 16, 0.8)',
                },
            };

            addUtilities(newUtilities, ['responsive', 'hover']);
        },
    ],
};
