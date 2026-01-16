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
        // Primary Colors - Deep Navy Blues
        'navy': {
          50: '#E8EDF5',
          100: '#C5D1E8',
          200: '#9BB0D4',
          300: '#6E8DBF',
          400: '#4A71AD',
          500: '#1E3A5F',
          600: '#0A1628',
          700: '#081220',
          800: '#050B14',
          900: '#03070C',
        },
        // Accent Colors - Teal (Trust & Innovation)
        'accent': {
          50: '#EFFBFB',
          100: '#D5F5F3',
          200: '#ABEAE6',
          300: '#7DDAD4',
          400: '#14B8A6',
          500: '#0D9488',
          600: '#0F766E',
          700: '#115E59',
          800: '#134E4A',
          900: '#0C353F',
        },
      },
      fontFamily: {
        'cairo': ['Cairo', 'sans-serif'],
        'inter': ['Inter', 'sans-serif'],
        'sans': ['Cairo', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      animation: {
        'fade-in-up': 'fadeInUp 0.8s ease-out',
        'fade-in-down': 'fadeInDown 0.8s ease-out',
        'slide-in-right': 'slideInRight 0.8s ease-out',
        'scale-in': 'scaleIn 0.6s ease-out',
        'float': 'float 3s ease-in-out infinite',
        'glow': 'glow 2s ease-in-out infinite',
        'blob': 'blob 7s infinite',
        'pulse-soft': 'pulse-soft 2s ease-in-out infinite',
      },
      keyframes: {
        fadeInUp: {
          '0%': {
            opacity: '0',
            transform: 'translateY(30px)'
          },
          '100%': {
            opacity: '1',
            transform: 'translateY(0)'
          },
        },
        fadeInDown: {
          '0%': {
            opacity: '0',
            transform: 'translateY(-30px)'
          },
          '100%': {
            opacity: '1',
            transform: 'translateY(0)'
          },
        },
        slideInRight: {
          '0%': {
            opacity: '0',
            transform: 'translateX(-50px)'
          },
          '100%': {
            opacity: '1',
            transform: 'translateX(0)'
          },
        },
        scaleIn: {
          '0%': {
            opacity: '0',
            transform: 'scale(0.8)'
          },
          '100%': {
            opacity: '1',
            transform: 'scale(1)'
          },
        },
        float: {
          '0%, 100%': {
            transform: 'translateY(0px)'
          },
          '50%': {
            transform: 'translateY(-20px)'
          },
        },
        glow: {
          '0%, 100%': {
            boxShadow: '0 0 20px rgba(13, 148, 136, 0.5)'
          },
          '50%': {
            boxShadow: '0 0 40px rgba(13, 148, 136, 0.8)'
          },
        },
        blob: {
          '0%': {
            transform: 'translate(0px, 0px) scale(1)',
          },
          '33%': {
            transform: 'translate(30px, -50px) scale(1.1)',
          },
          '66%': {
            transform: 'translate(-20px, 20px) scale(0.9)',
          },
          '100%': {
            transform: 'translate(0px, 0px) scale(1)',
          },
        },
        'pulse-soft': {
          '0%, 100%': {
            opacity: '1',
          },
          '50%': {
            opacity: '0.7',
          },
        },
      },
      boxShadow: {
        'glow-accent': '0 0 30px rgba(13, 148, 136, 0.5)',
        'glow-primary': '0 0 30px rgba(10, 22, 40, 0.5)',
      },
    },
  },
  plugins: [],
}
