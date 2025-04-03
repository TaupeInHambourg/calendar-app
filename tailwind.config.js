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
  },
  plugins: [],
}

