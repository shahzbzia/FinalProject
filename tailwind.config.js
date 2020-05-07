const { colors } = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
    	spacing: {
          '49': '12.5rem',
	        '72': '18rem',
          '83': '20.5rem',
	        '84': '21rem',
          '96': '24rem',
          '108': '27rem',
          '120': '30rem',
          '132': '33rem',
          '144': '36rem',
          '156': '39rem',
          '168': '42rem',
          '180': '45rem',
	        '192': '48rem',
    	},

    	width: {
	        '1/7': '14.2857143%',
	        '2/7': '28.5714286%',
	        '3/7': '42.8571429%',
	        '4/7': '57.1428571%',
	        '5/7': '71.4285714%',
	        '6/7': '85.7142857%',
          '2/100': '2.0000000%',
  		},

      height:{
        '2/100': '2.0000000%',
      },

      colors: {
        green: {
          ...colors.green,
          '500': '#00d1b2',
          '700': '#00c6a9',
          '300': '#84ffec',
        }
      },

      screens: {
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1025px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }
     },
  	}
  },
  variants: {
  	backgroundColor: ['responsive', 'hover', 'focus', 'active'],
  	textColor: ['responsive', 'hover', 'focus', 'active'],
  	rotate: ['responsive', 'hover', 'focus', 'active'],
  },
  plugins: [],
}
