/** @type {import('tailwindcss').Config} */
export default {
    content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
    darkMode: "class",
    daisyui: {
        themes: ["light"],
    },
    theme: {
        extend: {
            colors: {
                mainColor: "#28C76F",
                hoverEff: "#F8F8F8",
                secondaryColor: "#3852D8",
                tariffBg: "#DCD9FB",
                tariffText: "#757575",
                muted: "#B9B9C3",
                darkBg: "#2b2b2b",
                darkElBg: "#222",
                darkText: "#f1f3f5",
                darkInp: "#333333",
            }, width: {
                eighth: "12%",
                seventh: "14%",
                half: "49%",
                third: "32.5%",
                fourth: "24.5%",
                fifth: "19%",
                sixth: "16%",
            }, height: {
                half: "49%",
            }, maxHeight: {
                half: "49%",
            },
        },
    },
    plugins: [require("daisyui")],
};
