/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./**/*.php"],
  theme: {
    extend: {},
    colors: {
      'fjord': {
        '50': '#f5f7fa',
        '100': '#eaeef4',
        '200': '#d0dae7',
        '300': '#a8bbd1',
        '400': '#7896b8',
        '500': '#5779a0',
        '600': '#3e5879',
        '700': '#384f6c',
        '800': '#31435b',
        '900': '#2d3a4d',
        '950': '#1e2633',
      },
      'bone': {
        '20': '#FFFDFB',
        '50': '#f9f5f3',
        '100': '#f1e9e3',
        '200': '#d8c4b6',
        '300': '#ceb4a3',
        '400': '#b9927e',
        '500': '#ab7864',
        '600': '#9d6859',
        '700': '#83544b',
        '800': '#6b4641',
        '900': '#573b37',
        '950': '#2e1e1c',
      },
      'rainbow': {
        'melon': '#ffadad',
        'sunset': '#ffd6a5',
        'cream': '#fdffb6',
        'tea-green': '#caffbf',
        'electric-blue': '#9bf6ff',
        'jordy-blue': '#a0c4ff',
        'periwinkle': '#bdb2ff',
        'lavender': '#ffc6ff',
        'baby-powder': '#fffffc',
      }
    },
    spacing: {
      '0.5': '0.125rem',
      '1': '0.25rem',
      '1.5': '0.375rem',
      '2': '0.5rem',
      '2.5': '0.625rem',
      '3': '0.75rem',
      '3.5': '0.875rem',
      '4': '1rem',
      '5': '1.25rem',
      '6': '1.5rem',
      '7': '1.75rem',
      '8': '2rem',
      '9': '2.25rem',
      '10': '2.5rem',
      '11': '2.75rem',
      '12': '3rem',
      '14': '3.5rem',
      '16': '4rem',
      '20': '5rem',
      '24': '6rem',
      '28': '7rem',
      '32': '8rem',
      '36': '9rem',
      '40': '10rem',
      '44': '11rem',
      '48': '12rem',
      '52': '13rem',
      '56': '14rem',
      '60': '15rem',
      '64': '16rem',
      '72': '18rem',
      '80': '20rem',
      '96': '24rem',

      'vh-10': '10vh',
      'vh-20': '20vh',
      'vh-30': '30vh',
      'vh-40': '40vh',
      'vh-50': '50vh',
      'vh-60': '60vh',
      'vh-70': '70vh',
      'vh-80': '80vh',
      'vh-85': '85vh',
      'vh-90': '90vh',
      'vh-100': '100vh',

      'vw-10': '10vw',
      'vw-20': '20vw',
      'vw-30': '30vw',
      'vw-40': '40vw',
      'vw-50': '50vw',
      'vw-60': '60vw',
      'vw-70': '70vw',
      'vw-80': '80vw',
      'vw-90': '90vw',
      'vw-100': '100vw'
    }
  },
  plugins: [],
}

